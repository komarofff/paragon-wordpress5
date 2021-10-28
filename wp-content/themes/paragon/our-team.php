<main class="container-fluid mx-auto bg-light main-box ">
    <img class="r-top-team d-none d-md-block" src="<?= get_template_directory_uri() ?>/images/right-top-team.jpg"
         alt="bg">
    <img class="l-center-team d-none d-md-block" src="<?= get_template_directory_uri() ?>/images/left-center-team.jpg"
         alt="bg">
    <img class="r-bottom-team d-none d-md-block" src="<?= get_template_directory_uri() ?>/images/right-bottom-team.jpg"
         alt="bg">
    <div class="main-content">
        <div class="container our-team">
            <div class="row-box row d-flex justify-content-start mx-2">

                <?php
                $text_block = '
                 <div class="col-12 col-md-4 my-3  my-md-3 ">
                    <div class="col-12">
                        <div class="col-12 d-flex flex-column justify-content-between align-items-start">
                            <div class="team-broker-text-box">
                              <!--<p class="team-text">Our team</p>-->
                                <p class="team-title">Client partnerships that last beyond the deal</p>
                                <p class="team-text">
                                    Our brokers strive to build lasting partnerships with our clients. We support our
                                    clients at every step of the buying, selling, and the ownership process in order to
                                    help them maximize their success in investment real estate. Our main objective is to
                                    help our clients fulfill their short-and-long term investment goals while maximizing
                                    profitability for them.
                                </p>

                            </div>
                        </div>
                    </div>
                </div>';
                $query_posts = get_posts(array(
                    "post_type" => "broker",
                    "numberposts" => -1,
                    "post_status" => "publish"

                ));
                if(count($query_posts)==0){
                    echo $text_block;
                }
                $counter=0;
                foreach ($query_posts as $post_data) {
                    $counter++;
                    $the_image = wp_get_attachment_image_url($post_data->broker_image, array(320, 320));
                    echo '
                             
                 <div class="col-12 col-md-4 my-3  my-md-3 ">
                    <div class="col-12 d-flex flex-column justify-content-start align-items-start" style="min-height: 100%;">
                        <div class="team-broker-image-box" data-index="' . $post_data->ID . '"><img class="team-broker-image"
                                                                               src="' . $the_image . '"
                                                                               alt="' . $post_data->post_title . '"></div>
                        <div class="broker-information">
                            <p class="team-broker-name">' . $post_data->post_title . '</p>
                            <a class="team-broker-phone" href="tel:' . $post_data->phone . '">' . $post_data->phone . '</a>
                        </div>
                    </div>
                </div> ';
                    if(count($query_posts)==1){
                        echo $text_block;
                    }
                    if(count($query_posts)==2 && $counter==1 ){
                        echo $text_block;
                    }
                    if(count($query_posts) ==3 && $counter==2 ){
                        echo $text_block;
                    }
                    if(count($query_posts) >3 && $counter==3 ){
                        echo $text_block;
                    }
                }


                ?>


            </div>
        </div>
</main>
<div class="broker-page d-none" id="single_broker">

</div>
