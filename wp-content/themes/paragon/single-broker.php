<?php get_header(); ?>

    <div class="content mb-3 page-content">

        <?php
        global $post;
        $postBroker = $post;
        // get properties list
        $arr = get_posts(array(
            'post_type' => 'property',
            'post_status' => 'publish'
        ));
        $name = $postBroker->post_title;
        foreach ($arr as $item) {
            $list = $item->broker_features;
            if ($list) {
                foreach ($list as $listItem) {
                    if ($name == $listItem) {
                        if ($item->property_unpriced == 'on' or $item->property_price == '') {
                            $price = 'Unpriced';
                        } else {
                            $price = '$' . number_format($item->property_price, 0, ',', '.');
                        }
                        $im = get_the_post_thumbnail_url($item->ID, 'large');
                        if ($im == '') {
                            $im = get_template_directory_uri() . "/images/no-img.jpg";
                        }
                        $properties .= '

                                <div class="col-12 col-lg-6 my-3  bg-white px-0">
                                <a href = "' . $item->guid . '">
                                    <div class="property-block  d-flex flex-sm-nowrap flex-wrap me-2 ">
                                    <div class="col-12 col-sm-5  ps-0 pe-0">
                                    <div class="prop-image">
                                    <img src="' . $im . '" alt="prop image" class="single-image-property">
                                    <p class="property-details d-flex justify-content-center align-items-center "> <span class="me-2">Details</span>
                                <img src="' . get_template_directory_uri() . '/images/arrow-right.svg" alt="details"></p>
                            </div>
                            </div>
                                <div class="col-12 col-sm-7 d-flex flex-column justify-content-between align-items-start py-1 px-2">
                                    <div class="col-12">
                                        <p class="property-block-title">' . $item->post_title . '</p>
                                        <p class="property-block-gray-text">' . $item->property_address . '</p>
                                    </div>
                                    <div class="col-12">
                                        <p class="property-block-gray-text"><span>Property Type</span> <span class="property-block-text">' . get_prop_type($item->property_type) . '</span></p>
                                        <p class="property-block-gray-text"><span>Sales Price</span> <span class="property-block-text">' . $price . '</span></p>
                                        <p class="property-block-gray-text mb-0"><span>Status</span> <span class="property-block-text">' . get_prop_status($item->property_status) . '</span></p>
                                    </div>
                                </div>
                            </div>
                            </a>
                            </div>
                                ';


                    }
                }
            }
        }


        $social = '';
        if ($postBroker->broker_email && $postBroker->broker_email != '') {
            $social .= '
                                       <a href="mailto:' . $postBroker->broker_email . '">
                                       <img class="mr-2" src="' . get_template_directory_uri() . '/images/Mail.svg" alt="email">
                                       </a>
                                       ';
        }
        if ($postBroker->phone && $postBroker->phone != '') {
            $social .= '
                                       <a href="tel:' . $postBroker->phone . '">
                                       <img class="mr-2" src="' . get_template_directory_uri() . '/images/Email.svg" alt="email">
                                       </a>
                                       ';
        }
        if ($postBroker->phone2 && $postBroker->phone != '') {
            $social .= '
                                       <a href="tel:' . $postBroker->phone . '">
                                       <img class="mr-2" src="' . get_template_directory_uri() . '/images/Email.svg" alt="email">
                                       </a>
                                       ';
        }
        if ($postBroker->linkedin && $postBroker->linkedin != '') {
            $social .= '
                                       <a target="_blank" href="' . $postBroker->linkedin . '">
                                       <img class="mr-2" src="' . get_template_directory_uri() . '/images/linkedin-dark.svg" alt="email">
                                       </a>
                                       ';
        }

        $image = wp_get_attachment_image_url($postBroker->broker_image, array(320, 320));
        $brokerPage = '         
         <div class="container-fluid    " >
            <div class="container  mx-auto broker-head   d-flex justify-content-between align-items-center" style="min-height: 110px">
                <div class="row px-1  py-2 col-12 d-flex justify-content-between align-items-center w-full">
                    <p class="col-6 d-flex justify-content-start broker-title-name">' . $postBroker->post_title . '</p>
                 <!--<p class="close-broker-page col-6 col-md-1 d-flex justify-content-end align-items-center cursor-pointer">
                      <img class="cursor-pointer" src="' . get_template_directory_uri() . '/images/close.svg" alt="close menu">
                      <span class="ms-2 mb-1 cursor-pointer">Close</span>
                   </p>-->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="container-fluid">
            
                <div class="row  px-0 px-md-4 col-12 ms-1 ms-md-0">
               
                    <div class="order-2 order-md-1 col-12 col-md-5 d-flex flex-column justify-content-center align-items-center citate-block">
                        <div class="d-flex flex-column justify-content-center align-items-end">
                        <p class=" d-flex justify-content-start broker-title-name mb-4 me-4">' . $postBroker->post_title . '</p>
                           ' . $postBroker->comments . '
                        </div>
                    </div>
                    <div class="col-2 d-none  d-md-block"></div>
                    <div class="col-12 col-md-5  order-1 order-md-3">
                        <div class="team-broker-image-box">
                            <img src="' . $image . '" alt="' . $postBroker->post_title . '" class="team-broker-image" >
                        </div>
                    </div>
                </div>
                <div class="row  col-12 m-0">
                    <div class="col-3 d-md-block d-none"></div>
                    <div class="col-12 col-md-9 broker-block">
                        <div class="col-12 d-flex justify-content-between align-items-end">
                            <div>
                                <p class="block-broker-name ">' . $postBroker->post_title . '</p>
                                <p class="block-broker-sign">' . $postBroker->employee_position . '</p>
                            </div>
                            <div class="broker-social "><p>
                            ' . $social . '
                            </p></div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="col-12 block-broker-text">
                                ' . $postBroker->description . '
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row broker-page-bottom container mx-sm-0 px-sm-0 mx-md-2 px-md-2">
                <div class=" col-12 mb-4 mb-md-2">
                    <p class="col-12"><img src="' . get_template_directory_uri() . '/images/stripe.png" alt="stripe"><span class="stripe-title ms-1">
                    ' . $postBroker->post_title . ' latest projects</span>

                    </p>
                </div>
            </div>
            <div class="broker-page-latest-projects bg-md-white  ">
                <div class="row col-12 max-width">
                ' . $properties . '

                </div>

            </div>
        </div>

';

        echo $brokerPage;
        //////////////////////////////
        $search = "Multi-family";
        $params = array(
            'property_address',
            'property_type',
            'property_price',
            'property_unpriced',
            'property_features',
            'broker_features'

        );


//        global $wpdb;
//        $results = $wpdb->get_results("SELECT query1.*,query2.* FROM {$wpdb->prefix}wp_posts as query1      left join {$wpdb->prefix}wp_postmeta as query2 on (query1.ID=query2.post_id  and query2.meta_key='property_type') WHERE   (query1.post_status='publish' and query1.post_type='property')");
//        $meta = get_post_custom_keys($results[0]->ID);
//        //p_arr($meta);
//        $query_par = "SELECT query1.*,query2.* FROM {$wpdb->prefix}wp_posts as query1      left join {$wpdb->prefix}wp_postmeta as query2 on (query1.ID=query2.post_id  and ( ";
//        foreach ($meta as $item) {
//            $query_par .= " (query2.meta_key=".$item." and  query2.meta_value LIKE %".$search."%) OR ";
//        }
//        $query_par.= " 1=1 ) WHERE   (query1.post_status='publish' and query1.post_type='property') ";
//echo $query_par;
        //p_arr($results);


        //                $true_args = array(
        //                    'post_type' => 'property',
        //                    'numberposts' => -1,
        //                   //'s' => $search,
        //                    'meta_query' => array(
        //                        'relation' => 'OR',
        //                        array(
        //                           'key' => $params,
        //                         'value' => 'Multi-family',
        //                           'compare' => 'LIKE',
        //                        )
        //                    )
        //                );
        //$posts2 = get_posts( $true_args );

        //p_arr($posts2);

        ?>


    </div>

<?php get_footer(); ?>