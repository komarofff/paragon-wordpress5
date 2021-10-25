<?php

// require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

function get_select_html($data = [], $name = '', $id = '', $class = '', $selected = '')
{

    $html = '';

    if (count($data)) {
        $html = '<select id="' . $id . '" class="' . $class . '" name="' . $name . '">';
        foreach ($data as $key => $item) {
            $attr_selected = ($selected && $selected == $key) ? 'selected="selected"' : '';
            $html .= '<option value="' . $key . '" ' . $attr_selected . '>' . $item . '</option>';
        }
        $html .= '</select>';
    }

    return $html;
}


add_shortcode('home_properties', 'fn_home_properties');
add_shortcode('map', 'fn_map_all');

function fn_map_all()
{
    $data = '<div class="map-box" id="map">Map</div>';
    return $data;
}

add_shortcode('map_contact', 'fn_map_contact');
function fn_map_contact()
{
    $data = '<div class="map " id="map">Map contact page</div>';
    return $data;
}

function fn_map_single($lat, $lng, $prop_data)
{

    if ($lat && $lng && ($lat != '0' && $lng != '0')) {
        $data = '<div class="map_single " id="map">Map single</div>';
        $data .= '
    <script>
    let get_data = ' . $prop_data . '
   
   let single_popup = `<a href="${get_data.link}" class="col-12  my-2  bg-white px-0 " tabindex="0">
                            <div class="property-block  d-flex flex-sm-nowrap flex-wrap mx-2 my-3">
                            <div class="col-12 col-sm-5  ps-0 pe-0">
                            <div class="prop-image prop-image_home">
                            <img src="${get_data.image}" alt="prop image" class="single-image-property">
                            <!--<p class="property-details d-flex justify-content-center align-items-center "> <span class="me-2">Details</span> 
                            <img src="${get_data.folder}/images/arrow-right.svg" alt="details"></p>-->
                    </div>
                </div>
                    <div class="col-12 col-sm-7 d-flex flex-column justify-content-between align-items-start py-1 px-2">
                        <div class="col-12">
                            <p class="property-block-title">${get_data.title}</p>
                            <p class="property-block-gray-text">${get_data.address} </p>
                        </div>
                        <div class="col-12">
                            <p class="property-block-gray-text"><span>Property Type</span> <span class="property-block-text"> ${get_data.type}</span></p>
                            <p class="property-block-gray-text"><span>Sales Price</span> <span class="property-block-text">${get_data.price} </span></p>
                            <p class="property-block-gray-text mb-0"><span>Status</span> <span class="property-block-text">${get_data.status} </span></p>
                        </div>
                    </div>
                </div>
                </a>`
function initMap() {
    
    const icon_image = "http://paragon.vasterra.com/wp-content/uploads/2021/10/marker-image.png"
    const icon_image_red = "http://paragon.vasterra.com/wp-content/uploads/2021/10/marker-image-red.png"
    let lat = parseFloat(get_data.lat)
    let lng = parseFloat(get_data.lng)
  const center = { lat: parseFloat(get_data.lat), lng: parseFloat(get_data.lng) };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: center,
    panControl: false,
        zoomControl: false,
        scaleControl: false,
        streetViewControl: true,
                        streetViewControlOptions: {
                            position: google.maps.ControlPosition.LEFT_CENTER,
                        }
  })
  const contentString =`${single_popup}`;  
  const infowindow = new google.maps.InfoWindow({
    content: contentString,
  })  
  
  const marker = new google.maps.Marker({
    position: center,
    map,
    title: get_data.title,
    icon: icon_image
  })
  
infowindow.open({
      anchor: marker,
      map,
      shouldFocus: false      
    })
  marker.addListener("click", () => {
    infowindow.open({
      anchor: marker,
      map,
      shouldFocus: false,      
    })
  })
  //////////// arrows left-right-up-down
    const MapArrowsControlDiv = document.createElement("div");
    MapArrowsControlDiv.classList.add("map-arrows")
    MapArrowsControl(MapArrowsControlDiv, map, lng, lat);
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(MapArrowsControlDiv);
    /////////// zoom control
    const zoomControlDiv = document.createElement("div");
    ZoomControl(zoomControlDiv, map);
    zoomControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
  
}
   
    </script>

';
    } else {
        $data = '<div class="map_single " id="map">No map coordinates</div><script>function initMap() {}</script>';
    }
    return $data;

}


function fn_home_properties($atts)
{

    global $property_type;

    $data_posts = get_posts(array(
        'numberposts' => -1,
        'post_type' => 'property',
    ));

    $count_posts = count($data_posts);

    $data = '';

    $data .= '
  <div class="outside-block">
        <div class="bg-white">
            <div class="row mt-1 mb-3 d-lg-none">
                <div class="row mx-auto">
                    <button class="prop-switcher-button active-button">List</button>
                    <button class="prop-switcher-button">Map</button>
                </div>
            </div>
            <div class="row">
                <form action="" method="">                
                    <div class="col-12 search-zone">
                        <input name="property_search" type="text" placeholder="Search" class="search input_property_search" value="">                    
                        <input type="hidden" name="property_type" id="property_type" value="-1">                    
                        <button type="submit" class="search-button button_property_search">
                            <img src="' . get_template_directory_uri() . '/images/search-button.png" alt="search">
                        </button>                    
                    </div>
                </form>
            </div>
            
            <div class="row mt-1 ">
                <p class="col-12 d-flex justify-content-start align-items-center flex-wrap">';
    $data .= '<button class="properties-button properties-button-active button_property_type" data-type="-1">All</button>';
    foreach ($property_type as $key => $item) {
        $data .= '<button class="properties-button button_property_type" data-type="' . $key . '">' . $item . '</button>';
    }
    $data .= '</p>
            </div>';

    $data .= '<div class="row mt-1 ">
                <p class="col-12 ">
                    <span class="count_properties">' . $count_posts . '</span> Results
                </p>
            </div>
        </div>
        <div class="row  block-inner ">
              <div class="row col-12 max-width block-scroll home-wrap-properties">';

    $data .= get_property_list($data_posts);

    $data .= '
          </div>
        </div>        
    </div>
    <div class="row mt-1 mb-3 d-lg-none see-all-box">
        <div class="row mx-auto">
            <a href="' . home_url() . '/properties" class="see-all d-flex align-items-center py-2 px-8 justify-content-center">See all <img class="ms-2" src="' . get_template_directory_uri() . '/images/arrow-right-white.png" alt="arrow"></a>
        </div>
    </div>
  ';

    // foreach($data_posts as $item) {
    //   $data .= '<p>'.$item->post_title.'</p>';
    // }

    return $data;
}

function get_property_list($data_posts)
{

    global $property_type;
    global $property_status;

    $data = '';
    foreach ($data_posts as $item) {
        if ($item->property_unpriced == 'on' or $item->property_price == '') {
            $price = 'Unpriced';
        } else {
            $price = '$' . number_format($item->property_price, 0, ',', '.');
        }
        $map_coordinate = get_field('map_location', $item->ID);
        $lat = $map_coordinate['latitude'];
        $lng = $map_coordinate['longitude'];
        if ($lat == '') {
            $lat = 0;
        }
        if ($lng == '') {
            $lng = 0;
        }
        $im = get_the_post_thumbnail_url($item->ID, 'large');
        if($im==''){$im=get_template_directory_uri()."/images/no-img.jpg";}
        $data .= '          
            <a href=' . get_permalink($item->ID) . ' class="col-12  my-2  bg-white px-0 _item" 
            data-lat="' . $lat . '" data-lng="' . $lng . '" 
            data-index="' . $item->ID . '" data-image="' . $im . '"
            data-title="' . $item->post_title . '" data-link="' . get_permalink($item->ID) . '"
            data-meta="' . mb_strimwidth(get_post_meta($item->ID, 'property_address', true), 0, 31, '...') . '"
            data-type="' . $property_type[get_post_meta($item->ID, 'property_type', true)] . '"
            data-price="' . $price . '"
            data-status="' . $property_status[get_post_meta($item->ID, 'property_status', true)] . '"
            >
                <div class="property-block  d-flex flex-sm-nowrap flex-wrap mx-2 my-3">
                    <div class="col-12 col-sm-5  ps-0 pe-0">
                        <div class="prop-image prop-image_home">
                            <img src="' . $im . '" alt="prop image" class="single-image-property">
                            <p class="property-details d-flex justify-content-center align-items-center "><span
                                    class="me-2">Details</span> <img src="' . get_template_directory_uri() . '/images/arrow-right.svg" alt="details"></p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-7 d-flex flex-column justify-content-between align-items-start py-1 px-2">
                        <div class="col-12">
                            <p class="property-block-title">' . $item->post_title . '</p>
                            <p class="property-block-gray-text">' . mb_strimwidth(get_post_meta($item->ID, 'property_address', true), 0, 31, '...') . '</p>
                        </div>
                        <div class="col-12">
                            <p class="property-block-gray-text"><span>Property Type</span> <span
                                    class="property-block-text">' . $property_type[get_post_meta($item->ID, 'property_type', true)] . '</span></p>
                            <p class="property-block-gray-text"><span>Sales Price</span> <span
                                    class="property-block-text">' . $price . '</span></p>
                            <p class="property-block-gray-text mb-0"><span>Status</span> <span
                                    class="property-block-text">' . $property_status[get_post_meta($item->ID, 'property_status', true)] . '</span></p>
                        </div>
                    </div>
                </div>
            </a>';
    }

    return $data;
}

add_action('wp_footer', 'get_progerties_js', 99);
function get_progerties_js()
{
    if (is_front_page()) {
        ?>

        <script>


            function initMap(count = '') {


                const divs = document.querySelectorAll("._item")
                let div_arr = []
                divs.forEach((val) => {
                    div_arr.push(
                        {
                            lat: val.dataset.lat, lng: val.dataset.lng, popup:
                                `
                                <a href='${val.dataset.link}' class="col-12  my-2  bg-white px-0 " >
                            <div class="property-block  d-flex flex-sm-nowrap flex-wrap mx-2 my-3">
                            <div class="col-12 col-sm-5  ps-0 pe-0">
                            <div class="prop-image prop-image_home">
                            <img src="${val.dataset.image}" alt="prop image" class="single-image-property">
                            <p class="property-details d-flex justify-content-center align-items-center "> <span
                            class="me-2">Details</span> <img src="<?php echo get_template_directory_uri();?>/images/arrow-right.svg" alt="details"></p>
                    </div>
                </div>
                    <div class="col-12 col-sm-7 d-flex flex-column justify-content-between align-items-start py-1 px-2">
                        <div class="col-12">
                            <p class="property-block-title">${val.dataset.title} </p>
                            <p class="property-block-gray-text">${val.dataset.meta} </p>
                        </div>
                        <div class="col-12">
                            <p class="property-block-gray-text"><span>Property Type</span> <span
                                class="property-block-text"> ${val.dataset.type}</span></p>
                            <p class="property-block-gray-text"><span>Sales Price</span> <span
                                class="property-block-text">${val.dataset.price} </span></p>
                            <p class="property-block-gray-text mb-0"><span>Status</span> <span
                                class="property-block-text">${val.dataset.status} </span></p>
                        </div>
                    </div>
                </div>
                </a>
                    `,
                            title: val.dataset.title
                        }
                    )
                })

                //if (div_arr.length > 0) {
                if (div_arr.length == 0) {
                    div_arr.push({lat: 0, lng: 0, popup:'<p> No data</p>  '})
                }
                    console.log(div_arr)

                    const labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    const icon_image = 'http://paragon.vasterra.com/wp-content/uploads/2021/10/marker-image.png';//картинка иконки адреса
                    const icon_image_red = 'http://paragon.vasterra.com/wp-content/uploads/2021/10/marker-image-red.png';//картинка иконки адреса
                    const positions = div_arr
                    let lat = parseFloat(positions[0].lat)
                    let lng = parseFloat(positions[0].lng)
                    const center = {lat: lat, lng: lng};

                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 12,
                        center: center,
                        panControl: false,
                        zoomControl: false,
                        scaleControl: false,
                        streetViewControl: true,
                        streetViewControlOptions: {
                            position: google.maps.ControlPosition.LEFT_CENTER,
                        }
                    });

                    map.addListener("center_changed", () => {
                        var c = map.getCenter();
                        // console.log("center=" + c.lat() + ','
                        //     + c.lng() + ',' + map.getZoom());
                    })

                    var bounds = new google.maps.LatLngBounds();/// 1
                    var infowindow = new google.maps.InfoWindow();
                    for (let i = 0; i < positions.length; i++) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(positions[i].lat, positions[i].lng),
                            map,
                            title: positions[i].title,
                            //label: labels[i % labels.length],
                            icon: icon_image,
                            optimized: true

                        });
                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                            return function () {
                                infowindow.setContent(positions[i].popup);
                                infowindow.open(map, marker);
                            }
                        })(marker, i));

                        bounds.extend(marker.getPosition());/// 2
                    }
                    ///// 3
                    map.fitBounds(bounds);

                    ///
//add to init_map function
//////////// arrows left-right-up-down
                    const MapArrowsControlDiv = document.createElement("div");
                    MapArrowsControlDiv.classList.add('map-arrows')
                    MapArrowsControl(MapArrowsControlDiv, map, lng, lat);
                    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(MapArrowsControlDiv);
// /////////// zoom control
                    const zoomControlDiv = document.createElement('div');
                    ZoomControl(zoomControlDiv, map);
                    zoomControlDiv.index = 1;
                    map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);

                //}
            }


            jQuery(document).ready(function ($) {
                $('.button_property_type').on('click', function (e) {
                    e.preventDefault();
                    var button = $(this)
                    $('.button_property_type').removeClass('properties-button-active');
                    button.addClass('properties-button-active');

                    var type = button.attr('data-type');
                    $('#property_type').val(type);

                    $('.input_property_search').val('');

                    $.ajax({
                        type: 'POST',
                        url: ajaxUrl,
                        data: {
                            action: 'get_progerties',
                            type: type,
                            search: ''
                        },
                        dataType: "json",
                        success: function (res) {
                            if (res) {
                                $('.home-wrap-properties').html(res.data);
                                $('.count_properties').html(res.count);

                                initMap(res.data)

                                set_count_property_items();
                            }
                        }
                    });

                });

                $('.button_property_search').on('click', function (e) {
                    e.preventDefault();
                    var input = $('.input_property_search');
                    var search = input.val().trim();
                    if (!search) {
                        return false;
                    }
                    var type = $('#property_type').val();

                    $.ajax({
                        type: 'POST',
                        url: ajaxUrl,
                        data: {
                            action: 'get_progerties',
                            type: type,
                            search: search
                        },
                        dataType: "json",
                        success: function (res) {
                            if (res) {
                                $('.home-wrap-properties').html(res.data);
                                $('.count_properties').html(res.count);
                                initMap(res.data)

                                set_count_property_items();
                            }
                        }
                    });

                });

                set_count_property_items();

                function set_count_property_items() {
                    if (window.innerWidth < 992) {
                        $('.home-wrap-properties ._item').each(function (index, el) {
                            if (index > 3) {
                                $(el).addClass('d-none')
                            }
                        })
                    }
                    $(window).resize(function () {
                        if (window.innerWidth < 992) {
                            $('.home-wrap-properties ._item').each(function (index, el) {
                                if (index > 3) {
                                    $(el).addClass('d-none')
                                }
                            })
                        } else {
                            $('.home-wrap-properties ._item').removeClass('d-none')
                        }
                    })
                }
            });
        </script>
        <?php
    }
}

add_action('wp_ajax_get_progerties', 'get_progerties_fn');
add_action('wp_ajax_nopriv_get_progerties', 'get_progerties_fn');

function get_progerties_fn()
{
    $type = intval($_POST['type']);
    $search = $_POST['search'];
    $args = array(
        'numberposts' => -1,
        'post_type' => 'property',
    );
    if ($type > 0) {
        $args['meta_key'] = 'property_type';
        $args['meta_value'] = $type;
    }
    if ($search) {
        $args['s'] = $search;

    }
// // поиск по мета полям
//
//    $true_args = array(
//        'category_name'=> 'Properties',
//        'meta_query' => array(
//            array(
//                'key' => 'Property_type',
//                'value' => 'Multi-family',
//                'compare' => 'LIKE' //
//            )
//        )
//    );
    $data_posts = get_posts($args);

    $count_posts = count($data_posts);

    $data = json_encode(
        array(
            'count' => $count_posts,
            'data' => get_property_list($data_posts)
        )
    );

    echo $data;
    wp_die();
}


add_action('wp_footer', 'load_more_js', 99);
function load_more_js()
{
    ?>
    <script>
        jQuery(document).ready(function ($) {
            document.addEventListener('scroll', () => {
                var screenHight = document.documentElement.clientHeight;
                var bottomOffset = $(window).height() / 2;
                var type = $('#type').val();
                var search = $('#search').val();
                if (($(document).scrollTop() + $(window).height()) > ($(document).height() - bottomOffset) && !$('body').hasClass('loading_more')) {
                    var paged = $('#paged').val();
                    $.ajax({
                        type: 'POST',
                        url: ajaxUrl,
                        data: {
                            action: 'load_more',
                            paged: paged,
                            type: type,
                            search: search
                        },
                        beforeSend: function (xhr) {
                            $('body').addClass('loading_more');
                        },
                        success: function (res) {
                            if (res) {
                                $('#paged').val(+paged + 1);
                                $('._load_more').append(res);
                                $('body').removeClass('loading_more');
                            }
                        }
                    });
                }
                if ($('.up').length) {
                    if (pageYOffset > screenHight / 2) {
                        document.querySelector('.up').classList.remove('d-none');
                    } else {
                        document.querySelector('.up').classList.add('d-none');
                    }
                    document.querySelector('.up').addEventListener('click', () => {
                        window.scrollTo(0, 0);
                    })
                }
            });
        });
    </script>
    <?php
}

add_action('wp_ajax_load_more', 'load_more_fn');
add_action('wp_ajax_nopriv_load_more', 'load_more_fn');

function load_more_fn()
{
    $paged = intval($_POST['paged']);
    $type = intval($_POST['type']);
    $search = $_POST['search'];
    $args = array(
        'numberposts' => 4,
        'paged' => $paged + 1,
        'post_type' => 'property',
    );
    if ($type > 0) {
        $args['meta_key'] = 'property_type';
        $args['meta_value'] = $type;
    }
    if ($search) {
        $args['s'] = $search;
    }
    $data_posts = get_posts($args);

    echo get_property_list($data_posts);
    wp_die();
}


function Our_Team()
{
    if ($overridden_template = locate_template('our-team.php')) {
        load_template($overridden_template);
    }
}

add_shortcode('our_team', 'Our_Team');


function fn_contact_page_data($arr)
{
    $data = '
<div class=" d-flex flex-column justify-content-center align-items-start contact-page-box">
    <p class="prop-page-title">' . $arr['title'] . '</p>
    <p>
    ' . $arr['address'] . '
</p>
<p>
T: <a href="tel:' . $arr['phone'] . '">' . $arr['phone'] . '</a><br>
F: <a href="tel:' . $arr['fax'] . '">' . $arr['fax'] . '</a>
</p>
<p class="red-text">
 <a class="red-text" href="mailto:' . $arr['email'] . '">' . $arr['email'] . '</a>
</p>
 <p class="mt-4">
                        <a href="' . $arr['instagram'] . '"><img class="me-3" src="' . get_template_directory_uri() . '/images/instagram-mobile.svg" alt="instagram"></a>
                        <a href="' . $arr['facebook'] . '"><img class="me-3" src="' . get_template_directory_uri() . '/images/facebook-mobile.svg" alt="facebook"></a>
                        <a href="' . $arr['linkedin'] . '"><img class="me-3" src="' . get_template_directory_uri() . '/images/linkedin-mobile.svg" alt="linkedin"></a>
                    </p>
                    </div>
    ';

//    return p_arr($arr);
    return $data;
}

add_shortcode('contact_page_data', 'fn_contact_page_data');

function get_prop_type($val = 1)
{
    global $property_type;
    foreach ($property_type as $key => $item) {
        if ($val == $key) {
            return $item;
        }
    }
}

function get_prop_status($val = 1)
{
    global $property_status;
    foreach ($property_status as $key => $item) {
        if ($val == $key) {
            return $item;
        }
    }
}


function broker_page_js()
{
    ?>
    <script>
        // get client screen size
        let clientWidth = 0
        broker_data = ''
        document.addEventListener('DomContentLoaded', () => {
            clientWidth = document.documentElement.clientWidth
        })
        window.onresize = () => {
            clientWidth = document.documentElement.clientWidth
        }
        // open -- close broker page
        //open
        let flagOpen = false
        let idx = 0
        const brokers = document.querySelectorAll(".team-broker-image-box")
        brokers.forEach((val) => {
            val.addEventListener("click", (e) => {
                //height of head
                const elem2 = document.querySelector(".header-box")
                const hHeader2 = elem2.getBoundingClientRect().height
                idx = val.dataset.index
                document.querySelector(".broker-page").classList.remove("d-none")

                jQuery(document).ready(function ($) {
                    $.ajax({
                        type: 'POST',
                        url: ajaxUrl,
                        data: {
                            action: 'get_broker_data',
                            idD: idx
                        },
                        success: function (responsive) {
                            if (responsive) {
                                broker_data = responsive

                                document.getElementById('single_broker').innerHTML = `
                                <div class="container-fluid   border-bottom ">
            <div class="container  mx-auto broker-head   d-flex justify-content-between align-items-center" style="min-height: ${hHeader2}px">
                                ${broker_data}`

                                flagOpen = true
                                setTimeout(() => {
                                    document.querySelector(".broker-page").style.cssText = `
       -webkit-transform: translateX(0vw);
       -moz-transform: translateX(0vw);
       -ms-transform: translateX(0vw);
       -o-transform: translateX(0vw);
       transform: translateX(0vw); `
                                }, 100)
                                addModal()
                                closeBrokerPage()
                            }
                        }
                    })
                })


            })

        })

        //close
        function closeBrokerPage() {
            if (flagOpen) {
                let targetClose = document.getElementById('single_broker').querySelector(".close-broker-page")
                document.getElementById('single_broker').querySelector(".close-broker-page").addEventListener("click", () => {
                    if (clientWidth >= 768) {
                        document.querySelector(".broker-page").style.cssText = `
       -webkit-transform: translateX(85vw);
       -moz-transform: translateX(85vw);
       -ms-transform: translateX(85vw);
       -o-transform: translateX(85vw);
       transform: translateX(85vw); `
                    } else {
                        document.querySelector(".broker-page").style.cssText = `
       -webkit-transform: translateX(100vw);
       -moz-transform: translateX(100vw);
       -ms-transform: translateX(100vw);
       -o-transform: translateX(100vw);
       transform: translateX(100vw); `
                    }

                    setTimeout(() => {
                        document.querySelector(".broker-page").classList.add("d-none")
                        document.getElementById('single_broker').innerHTML = ``
                        removeModal()
                    }, 300)
                    flagOpen = false

                })
            }
        }

        function addModal() {
            document.querySelector(".modal-black").classList.remove("d-none")

        }

        function removeModal() {
            document.querySelector(".modal-black").classList.add("d-none")

        }


    </script>
    <?php
}

add_action('wp_ajax_nopriv_get_broker_data', 'fn_getBrokerData');
add_action('wp_ajax_get_broker_data', 'fn_getBrokerData');

function fn_getBrokerData()
{

    $broker_idx = intval($_POST['idD']);
    $properties = '';
    $postBroker = get_post($broker_idx);
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
                    if($im==''){$im=get_template_directory_uri()."/images/no-img.jpg";}
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


    $brokerPage = '         
                <div class="row px-1  py-2 col-12 d-flex justify-content-between align-items-center w-full">
                    <p class="col-6 d-flex justify-content-start broker-title-name">' . $postBroker->post_title . '</p>
                    <p class="close-broker-page col-6 col-md-1 d-flex justify-content-end align-items-center cursor-pointer">
                        <img class="cursor-pointer" src="' . get_template_directory_uri() . '/images/close.svg" alt="close menu">
                        <span class="ms-2 mb-1 cursor-pointer">Close</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="block-overflow">
            <div class="container-fluid">
                <div class="row  px-0 px-md-4 col-12 ms-1 ms-md-0">
                    <div class="order-2 order-md-1 col-12 col-md-5 d-flex flex-column justify-content-center align-items-center citate-block">
                        <div class="d-flex flex-column justify-content-center align-items-end">
                           ' . $postBroker->comments . '
                        </div>
                    </div>
                    <div class="col-2 d-none  d-md-block"></div>
                    <div class="col-12 col-md-5  order-1 order-md-3">
                        <img style="min-width:100%; min-height;100%;" src="' . wp_get_attachment_image_url($postBroker->broker_image, array(320, 320)) . '" alt="' . $postBroker->post_title . '">
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

    die();
}

function getUrlMimeType($url)
{
    $buffer = file_get_contents($url);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    return $finfo->buffer($buffer);
}

?>