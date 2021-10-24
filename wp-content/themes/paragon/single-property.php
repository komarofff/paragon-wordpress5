<?php get_header(); ?>

<main class="container-fluid mx-auto bg-light main-box ">

    <?php
    global $post;
 $im = get_the_post_thumbnail_url($post->ID, 'large');
    if($im==''){$im=get_template_directory_uri()."/images/no-img.jpg";}
    ?>
    <div class="main-content  bg-light">
        <div class=" prop-single container">
            <div class="row  mt-4">
                <div class="col-12 col-md-6 slider-box">
                    <div class="slider">
                        <div><img class="slider-image"
                                  src="<?php echo $im; ?>" alt="big"></div>
                        <?php $image_arr = get_post_meta($post->ID, 'property_images', true);
                        $image_first = get_the_post_thumbnail_url($post->ID, 'small');
                        if($image_first==''){$image_first=get_template_directory_uri()."/images/no-img.jpg";}
                        foreach ($image_arr as $item) {
                            $post_id = $item;
                            $the_image = wp_get_attachment_image_url($post_id, array(320, 320));
                            if($the_image==''){
                                //$the_image=get_template_directory_uri()."/images/no-img.jpg";
                                $the_image= get_the_post_thumbnail_url($post->ID, 'small');
                            }
                            echo '
                        <div><img class="slider-image 555" src="' . $the_image . '" alt="big"></div>
                        ';
                        }
                        ?>
                    </div>

                </div>
                <div class="col-12 col-md-6 d-flex flex-column align-items-start justify-content-between">
                    <div class="col-12 mt-4 mt-md-0">
                        <p class="prop-page-title"><?php echo $post->post_title; ?> </p>
                        <p class="broker-info"><?php echo $post->property_address; ?></p>
                    </div>
                    <div class="col-12 ">
                        <div class="col-12 col-md-6 mt-3 mt-md-0">
                            <p class="property-block-gray-text"><span>Property Type</span> <span
                                        class="property-block-text"><?php echo get_prop_type($post->property_type); ?></span>
                            </p>
                            <p class="property-block-gray-text"><span>Sales Price</span>
                                <span
                                        class="property-block-text">
                                    <?php
                                    if ($post->property_unpriced == 'on' or $post->property_price == '') {
                                        $price_prop = 'Unpriced';
                                        echo $price_prop;
                                    } else {
                                        $price_prop = '$' . number_format($post->property_price, 0, ',', '.');
                                        echo $price_prop;
                                    }
                                    ?>
                                </span>
                            </p>
                            <p class="property-block-gray-text mb-0"><span>Status</span> <span
                                        class="property-block-text"><?php echo get_prop_status($post->property_status); ?></span>
                            </p>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-12 mt-3 mt-md-0">
                            <p class="project-title">Project highlights:</p>
                            <div class="col-12 d-flex align-items-start justify-content-start flex-wrap flex-md-nowrap">
                                <ul class="col-12 col-md-6  list-prop ps-3">
                                    <?php
                                    $counter = 0;
                                    $property_features = get_post_meta($post->ID, 'property_features', true);
                                    foreach ($property_features as $item) {
                                        echo '<li>' . $item . '</li>';
                                        $counter++;
                                        if ($counter % 4 == 0) {
                                            echo '</ul><ul class="col-12 col-md-6  list-prop ps-3">';
                                        }
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php $post2 = get_post($post->flyer);
                    $flyer = $post2->guid;
                    $map_coordinate = get_field('map_location');
                    $lat = $map_coordinate['latitude'];
                    $lng = $map_coordinate['longitude'];
                    if($lat==''){$lat=0;}
                    if($lng==''){$lng=0;}
                    $property_data = array(
                            'folder'=>get_template_directory_uri(),
                        'lat' => $lat,
                        'lng' => $lng,
                        'link' => get_permalink($post->ID),
                        'image' => $image_first,
                        'title' => $post->post_title,
                        'address' => $post->property_address,
                        'type' => get_prop_type($post->property_type),
                        'price' => $price_prop,
                        'status' => get_prop_status($post->property_status)
                    );
                    ?>

                    <div class="col-12 mb-4">
                        <?php
                        if (getUrlMimeType($flyer) == 'application/pdf') {

                            echo '   <a target="_blank" href="' . $flyer . '" class="prop-button">Download flyer</a>';
                        }
                        ?>
                    </div>

                </div>
            </div>

            <div class="row  my-4">
                <div class="col-12 col-lg-6 map-page">

                    <?php

                    echo fn_map_single($lat, $lng, json_encode($property_data)); ?>

                </div>
                <div class="col-12 col-lg-6 mt-4 mt-md-0">
                    <?php
                    $brokers_arr = $post->broker_features;
                    $query_posts = get_posts(array(
                        "post_type" => "broker",
                        "numberposts" => -1,
                        "post_status" => "publish"

                    ));
                    if ($brokers_arr) {
                        $numItems = count($brokers_arr);
                        $i = 0;
                        foreach ($brokers_arr as $item) {
                            foreach ($query_posts as $post_data)
                                if ($item == $post_data->post_title) {
                                    $the_image = wp_get_attachment_image_url($post_data->broker_image, array(320, 320));
                                    if (++$i === $numItems) {
                                        echo '
                             <div class="col-12  col-md-6 d-flex justify-content-start flex-md-nowrap flex-wrap align-items-end ">
                        <div class="col-12 col-md-6 team-broker-image-box"><img class="team-broker-image"
                                                                                src="' . $the_image . '"
                                                                                alt="broker"></div>
                        <div class="col-12 col-md-6 broker-information ps-0  ps-md-3">
                            <p class="broker-name">' . $post_data->post_title . '</p>
                            <p class="broker-profession">' . $post_data->employee_position . '</p>
                            <a class="broker-info" href="tel:'. $post_data->phone .'">'. $post_data->phone . '</a>
                            <a class="broker-info" href="mailto:' . $post_data->broker_email . '">' . $post_data->broker_email . '</a>
                        </div>
                    </div>
                            ';
                                    } else {
                                        echo '
                             <div class="col-12 col-md-6 d-flex justify-content-start flex-md-nowrap flex-wrap align-items-end mb-3">
                        <div class="col-12 col-md-6 team-broker-image-box"><img class="team-broker-image"
                                                                                src="' . $the_image . '"
                                                                                alt="broker"></div>
                        <div class="col-12 col-md-6 broker-information ps-0  ps-md-3">
                            <p class="broker-name">' . $post_data->post_title . '</p>
                            <p class="broker-profession">' . $post_data->employee_position . '</p>
                            <p class="broker-info">' . $post_data->phone . '</p>
                            <a class="broker-info" href="mailto:' . $post_data->broker_email . '">' . $post_data->broker_email . '</a>
                        </div>
                    </div>
                            ';
                                    }
                                }
                        }
                    }

                    ?>

                </div>
            </div>


        </div>
    </div>

</main>


<?php get_footer(); ?>

