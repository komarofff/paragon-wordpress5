<!DOCTYPE html>
<?php echo '<html lang="en">';?>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
	
	<link rel="shortcut icon" href="<?= home_url(); ?>/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="<?= home_url(); ?>/favicon.ico" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	

    <title><?php echo get_the_title() .". ".get_bloginfo('name'); ?></title>
	
	<script>var ajaxUrl="<?php echo admin_url('admin-ajax.php'); ?>";</script>


	<?php wp_head(); ?>

</head>
<?php
	echo '<body class="container-fluid" style="margin-top:20px;">';
?>

    <?php
//    if( is_admin_bar_showing() ) {
//        if (is_front_page()) {
//            $class_header = 'bg-white border-bottom';
//            echo '<header id="header" class="container-fluid position-fixed top-0 left-0 right-0 header-box head-block-start bg-white " style="margin-top:30px;">';
//        } else {
//            echo '<header id="header" class="container-fluid position-fixed top-0 left-0 right-0 header-box head-block-start bg-light border-bottom"  style="margin-top:30px;">';
//        }
//    }else {
//        if (is_front_page()) {
//            $class_header = 'bg-white border-bottom';
//            echo '<header id="header" class="container-fluid position-fixed top-0 left-0 right-0 header-box head-block-start bg-white " >';
//        } else {
//            echo '<header id="header" class="container-fluid position-fixed top-0 left-0 right-0 header-box head-block-start bg-light border-bottom"  >';
//        }
//    }
    if (is_front_page()) {
        $class_header = 'bg-white border-bottom';
        echo '<header id="header" class="container-fluid position-fixed top-0 left-0 right-0 header-box head-block-start bg-none " >';
    } else {
        echo '<header id="header" class="container-fluid position-fixed top-0 left-0 right-0 header-box head-block-start bg-light border-bottom"  >';
    }
    ?>

    <div class="container  mx-auto head-block">
        <div class="row d-flex justify-content-between align-items-center py-1">
            <div class="col-lg-3 col-md-3 col-6">
                <a href="<?= home_url(); ?>">
                    <img class="header-logo" src="<?= get_template_directory_uri(); ?>/images/logo.png" alt="<?= bloginfo( 'sitename' ); ?>">
                </a>
            </div>            
            <?php $menu = wp_nav_menu( [
					'theme_location'  => 'menutop',
					'menu'            => '', 
					'container'       => 'nav', 
					'container_class' => 'col-md-8 col-12 d-none d-md-block', 
					'container_id'    => '',
					'menu_class'      => '', 
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => '',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul class="top-menu">%3$s</ul>',
					'depth'           => 1					
				] );
			?>
            <img class="mobile-switcher d-block d-md-none" src="<?= get_template_directory_uri(); ?>/images/menu.svg" alt="switcher">
            <div class="col-6  mobile d-md-none mobile-menu">
                <div class=" d-flex justify-content-end align-items-center mt-0">
                    <p class="mobile-close d-flex justify-content-between align-items-center cursor-pointer">
                        <img class="cursor-pointer" src="<?= get_template_directory_uri(); ?>/images/close.svg" alt="close menu">
                        <span class="ms-2 mb-1 cursor-pointer">Close</span>
                    </p>
                </div>                
                <?php $menu = wp_nav_menu( [
					'theme_location'  => 'menutop',
					'menu'            => '', 
					'container'       => false, 
					'container_class' => '', 
					'container_id'    => '',
					'menu_class'      => '', 
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => '',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul>%3$s</ul>',
					'depth'           => 1					
				] );
			    ?>
                <?php
                global $linkedin_link;
                global $instagram_link;
                ?>
                <div class="d-flex justify-content-start align-items-center mt-4">
                    <p class="mt-4">
                        <a target="_blank" href="<?php echo $instagram_link;?>"><img class="me-3" src="<?= get_template_directory_uri(); ?>/images/instagram-mobile.svg" alt="instagram"></a>

                        <a  target="_blank"  href="<?php echo $linkedin_link;?>"><img class="me-3" src="<?= get_template_directory_uri(); ?>/images/linkedin-mobile.svg" alt="linkedin"></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>
