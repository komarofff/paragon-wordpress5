<?php

// require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

add_action('init', 'func_register_post_type');
function func_register_post_type()
{

    register_post_type('property', array(
        'labels' => array(
            'name' => 'Properties',
            'singular_name' => 'Property',
            'add_new' => 'Add new',
            'add_new_item' => 'Add new property',
            'edit_item' => 'Edit property',
            'new_item' => 'New property',
            'view_item' => 'View property',
            'search_items' => 'Find property',
            'not_found' => 'No properties found',
            'not_found_in_trash' => 'No properties found in the trash',
            'parent_item_colon' => '',
            'menu_name' => 'Properties'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 1,
        'menu_icon' => 'dashicons-admin-home',
        'supports' => array('title', 'thumbnail')
    ));

}

function add_review_meta_boxes()
{
    add_meta_box('property_address', 'Address', 'fn_property_address', 'property', 'normal', 'high');
    add_meta_box('property_type', 'Type', 'fn_property_type', 'property', 'normal', 'high');
    add_meta_box('property_price', 'Price', 'fn_property_price', 'property', 'normal', 'high');
    add_meta_box('property_status', 'Status', 'fn_property_status', 'property', 'normal', 'high');
    add_meta_box('property_features', 'Highlights', 'fn_property_features', 'property', 'normal', 'high');
    add_meta_box('broker_features', 'Brokers', 'fn_broker_features', 'property', 'normal', 'high');
    add_meta_box('property_images', 'Property images', 'fn_property_images', 'property', 'normal', 'high');

    add_meta_box('list_of_properties', 'List of properties', 'fn_list_of_properties', 'broker', 'normal', 'low');

}

add_action('add_meta_boxes', 'add_review_meta_boxes');

function fn_list_of_properties($post)
{
    $data = '<div style="width:30%; max-height:400px; overflow-y: auto">';
    $name = $post->post_title;
    $arr = get_posts(array(
        'post_type' => 'property',
        'post_status' => 'publish'
    ));
    foreach ($arr as $item) {
        $list = $item->broker_features;
        if ($list) {
            foreach ($list as $listItem) {
                if ($name == $listItem) {
                    $data .= "<h4 style='margin:0;display:flex; justify-content: space-between; align-items: center;'>" . $item->post_title . "<p style='margin:0;'><a target='_blank' style='margin-left:20px;' href='" . $item->guid . "'>To see </a> <a target='_blank' style='margin-left:20px;' href='/wp-admin/post.php?post=" . $item->ID . "&action=edit'>Edit</a></p></h4><hr>";
                }
            }
        }
    }


    $html = $data . "</div>";

    echo $html;
}

function fn_property_address($post)
{


    $html = '<input id="property_address_for_map" class="w-100" name="property_address" type="text" placeholder="Property address" value="' . get_post_meta($post->ID, 'property_address', true) . '">
    <p style="cursor:pointer;width: 200px;padding:5px 10px; border:1px solid #ccc; background:#fff; color: #000; display:none;" id="get_map_coordinate" data-address="' . get_post_meta($post->ID, 'property_address', true) . '">Get map coordinate from addresss</button></p>
    ';


    echo $html;
}

function fn_property_type($post)
{

    global $property_type;

    $html = get_select_html($property_type, 'property_type', null, 'w-50', get_post_meta($post->ID, 'property_type', true));

    echo $html;
}

function fn_property_price($post)
{
    $flag = get_post_meta($post->ID, 'property_unpriced', true);
    if ($flag == 'on') {
        $html = '<input  id="property_price_admin" class="w-50" name="property_price" type="number" placeholder="Property price" value="' . get_post_meta($post->ID, 'property_price', true) . '"> $';
        $html .= '<label for="unpriced"> <input style="margin-left:20px;" type="checkbox" id="unpriced" name="property_unpriced" checked >Unpriced</label>';
    } else {
        $html = '<input id="property_price_admin" class="w-50" name="property_price" type="number" placeholder="Property price" value="' . get_post_meta($post->ID, 'property_price', true) . '"> $';
        $html .= '<label for="unpriced"> <input style="margin-left:20px;" type="checkbox" id="unpriced" name="property_unpriced" >Unpriced</label>';
    }

    echo $html;
}


function fn_property_status($post)
{

    global $property_status;

    $html = get_select_html($property_status, 'property_status', null, 'w-50', get_post_meta($post->ID, 'property_status', true));

    echo $html;
}

function fn_property_images($post)
{
    if (function_exists('fn_property_images_html')) {
        fn_property_images_html('images', get_post_meta($post->ID, 'property_images', true));
    }
}

function fn_property_images_html($name, $meta, $w = 115, $h = 90)
{
    $no_img = get_stylesheet_directory_uri() . '/images/no-img.jpg';
    echo '<div class="images" style="padding: 12px 0;">';
    echo '<input type="hidden" id="noImg" value="' . $no_img . '">';
    $_key = 0;
    if ($meta) {
        foreach ($meta as $key => $value) {
            if ($value) {
                $_key++;
                $image_attributes = wp_get_attachment_image_src($value, array($w, $h));
                $src = $image_attributes[0];
                echo '
              <div style="display: inline-block; margin: 0 12px 12px 0;" class="images_item">
                  <img data-src="' . $no_img . '" src="' . $src . '" width="' . $w . 'px" height="' . $h . 'px" class="img_item" />
                  <div>
                      <input  type="hidden" name="' . $name . '[' . $_key . ']" id="' . $name . '[' . $_key . ']" value="' . $value . '" class="field_img_id"/>
                      <button type="submit" class="upload_image_button button">Download</button>
                      <button type="submit" class="remove_image_button button">&times;</button>
                  </div>
              </div>   
              ';
            }
        }
    }
    if (!$_key) {
        echo '
      <div style="display: inline-block; margin: 0 12px 12px 0;" class="images_item">
          <img data-src="' . $no_img . '" src="' . $no_img . '" width="' . $w . 'px" height="' . $h . 'px" class="img_item" />
          <div>
              <input type="hidden" name="' . $name . '[1]" id="' . $name . '[1]" value="' . $value . '" class="field_img_id"/>
              <button type="submit" class="upload_image_button button">Download</button>
              <button type="submit" class="remove_image_button button">&times;</button>
          </div>
      </div>   
      ';
    }
    echo '</div>';
    echo '<button id="add_load" class="button">Add</button>';
}

function fn_property_features($post)
{

    $property_features = get_post_meta($post->ID, 'property_features', true);

    $html = '<div class="list_input">';

    if (!$property_features) {
        $property_features = [''];
    }
    foreach ($property_features as $key => $item) {
        if (!$key || ($key && $item != '')) {
            $html .= '<div class="list_input__item" style="margin-bottom: 10px;">';
            $html .= '<input type="text" class="w-75" name="property_features[]" value="' . $item . '">';
            $html .= '<button class="button delete_input" style="margin-left: 10px;">Delete</button>';
            $html .= '</div>';
        }
    }

    $html .= '</div>';

    $html .= '<div style="padding-top: 10px;"><button id="add_list_input" class="button">Add</button></div>';

    echo $html;
}


///////////////////////  Broker page
add_action('init', 'func_broker');
function func_broker()
{
    register_post_type('broker', array(
        'labels' => array(
            'name' => 'Teammates',
            'singular_name' => 'Teammate',
            'add_new' => 'Add new',
            'add_new_item' => 'Add new Teammate',
            'edit_item' => 'Edit Teammate',
            'new_item' => 'New Teammate',
            'view_item' => 'View Teammate',
            'search_items' => 'Find Teammate',
            'not_found' => 'No Teammates found',
            'not_found_in_trash' => 'No Teammates found in the trash',
            'parent_item_colon' => '',
            'menu_name' => 'Teammates',


        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 0,
        'menu_icon' => 'dashicons-admin-users',
        'supports' => array('title', 'thumbnail')
    ));
}

/// checkbox select
function fn_broker_features($post)
{
    $broker_features = get_post_meta($post->ID, 'broker_features', true);
    $counter = 0;
    if ($broker_features) {
        echo "<h4>Selected brokers</h4><ol style='display: flex;'>";
        foreach ($broker_features as $broker) {
            echo '<li style="margin-right: 40px;"">' . $broker . '</li>';
        }
        echo "</ol>";
    }

    if (!$broker_features) {
        $broker_features = [''];
    }

    $html = '
<p><strong>Choose broker</strong></p>
<div class="" style="width:300px; border:1px solid #ccc; height: 200px; overflow-y: auto ">
<fieldset>
  ';

    $arr = get_posts(array(
        "post_type" => "broker",
        "numberposts" => -1,
        "post_status" => "publish"
    ));

    foreach ($arr as $item) {

        if ($broker_features[$counter] == $item->post_title) {
            $counter++;

            $html .= ' <div style="display:flex; align-items:center; margin:10px;">
    <input type="checkbox" id="broker-' . $counter . '" name="broker_features[]" value="' . $item->post_title . '" checked>
    <label for="broker-' . $counter . '"> ' . $item->post_title . '</label>
  </div>';

        } else {

            $html .= ' <div style="display:flex; align-items:center; margin:10px;">
    <input type="checkbox" id="broker-' . $counter . '" name="broker_features[]" value="' . $item->post_title . '" >
    <label for="broker-' . $counter . '"> ' . $item->post_title . '</label>
  </div>';
        }


    }

    $html .= '
</fieldset>
</div>
';

    echo $html;
}

// multiple select
//function fn_broker_features($post)
//{
//    $broker_features = get_post_meta($post->ID, 'broker_features', true);
//    $counter = 0;
//    if ($broker_features) {
//        echo "<h3>Selected brokers</h3><ol>";
//        foreach ($broker_features as $broker) {
//            echo '<li>' . $broker . '</li>';
//        }
//        echo "</ol>";
//    }
//    $html = '<div class=""> ';
//
//    if (!$broker_features) {
//        $broker_features = [''];
//    }
//    $html .= '<div class="" style="margin-bottom: 10px;">';
//    $html .= ' <select name="broker_features[]" value="" style="min-width:500px;height:200px;" multiple>';
//    $arr = get_posts(array(
//        "post_type" => "broker",
//        "numberposts" => -1,
//        "post_status" => "publish"
//    ));
//    foreach ($arr as $item) {
//        if ($broker_features[$counter] == $item->post_title) {
//            $counter++;
//            $html .= '<option value="' . $item->post_title . '" selected>' . $item->post_title . '</option>';
//        } else {
//            $html .= '<option value="' . $item->post_title . '">' . $item->post_title . '</option>';
//        }
//    }
//    $html .= '</select></div></div>';
//    echo $html;
//}

//////////////////////////////////////////
// start
function wph_require_featured_image($post_id) {
    $post = get_post($post_id);
    $screen = get_current_screen();
  if ('property' === $screen->post_type) {
      if ($post->post_status == 'publish' && !has_post_thumbnail($post_id)) {
          $post->post_status = 'draft';
          wp_update_post($post);

          $message = '<p>You forgot to set the featured image!</p><p><a href="' . admin_url('post.php?post=' .
                  $post_id . '&action=edit') . '">Click here  and set it</a></p>';
          wp_die($message, 'Error - You forgot to set the featured image');
      }
  }
}
add_action('save_post', 'wph_require_featured_image', -1);
// end
//function featured_image_requirement()
//{
//    $screen = get_current_screen();
//    if ('property' === $screen->post_type) {
//        if (!has_post_thumbnail()) {
//     wp_die('You forgot to set the featured image. Click the back button on your browser and set it.');
//        }
//    }
//}
//add_action('pre_post_update', 'featured_image_requirement');


function save_box_data($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    update_post_meta($post_id, 'property_images', $_POST['images']);
    update_post_meta($post_id, 'property_address', $_POST['property_address']);
    update_post_meta($post_id, 'property_type', $_POST['property_type']);
    update_post_meta($post_id, 'property_price', $_POST['property_price']);
    update_post_meta($post_id, 'property_unpriced', $_POST['property_unpriced']);
    update_post_meta($post_id, 'property_status', $_POST['property_status']);
    update_post_meta($post_id, 'property_features', $_POST['property_features']);
    update_post_meta($post_id, 'broker_features', $_POST['broker_features']);
    update_post_meta($post_id, 'list_of_properties', $_POST['list_of_properties']);
    return $post_id;
}

add_action('save_post', 'save_box_data');



