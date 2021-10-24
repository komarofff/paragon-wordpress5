<?php get_header(); ?>

<!--<div style="padding-top: 100px;"></div>-->

<?php

global $property_type;
global $property_status;

$args = array(
    'numberposts' => 4,
    'paged' => 1,
    'post_type'   => 'property',
);

if( isset($_GET['property_type']) ) {
    $args['meta_key'] = 'property_type';
    $args['meta_value'] = $_GET['property_type'];
}
if( isset($_GET['property_search']) ) {
    $args['s'] = $_GET['property_search'];
}

$data_posts = get_posts( $args );

$args['numberposts'] = -1;
$count_posts = count(get_posts( $args ));

?>

<input type="hidden" id="paged" value="1">
<input type="hidden" id="type" value="<?php echo isset($_GET['property_type']) ? intval($_GET['property_type']) : -1; ?>">
<input type="hidden" id="search" value="<?php echo isset($_GET['property_search']) ? $_GET['property_search'] : ''; ?>">

<main class="container-fluid mx-auto bg-light main-box ">
    <div class="container mt-4">
        <div class="row mt-3">
            <a href="<?php echo home_url(); ?>/#home_properties" class="col-12 d-flex justify-content-start align-items-center">
                <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-left-red.png" alt="back">
                <span class="ms-2 red-text">Back</span>
            </a>
        </div>
        <div class="row mt-1">
            <p class="col-12 d-flex justify-content-start align-items-center">
                <img src="<?php echo get_template_directory_uri(); ?>/images/stripe.png" alt="stripe">
                <span class="stripe-title ms-2">Listed properties</span>
            </p>
        </div>
        <div class="row mt-1">
            <form action="./" method="GET">
                <div class="col-12 search-zone">
                    <input name="property_search" type="text" placeholder="Search" class="search" value="<?php echo $_GET['property_search']; ?>">
                    <?php if($_GET['property_type']): ?>
                        <input type="hidden" name="property_type" value="<?php echo $_GET['property_type']; ?>">
                    <?php endif; ?>
                    <button type="submit" class="search-button">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/search-button.png" alt="search">
                    </button>                    
                </div>
            </form>
        </div>
        <div class="row mt-1">
            <p class="col-12 d-flex justify-content-start align-items-center flex-wrap">
                <?php $active_class = !isset($_GET['property_type']) ? 'properties-button-active' : ''; ?>
                <a href="./" class="properties-button <?php echo $active_class; ?>" data-type="-1">All</a>
                <?php foreach($property_type as $key => $item): ?>
                    <?php $active_class = $key == $_GET['property_type'] ? 'properties-button-active' : ''; ?>
                    <a href="./?property_type=<?php echo $key; ?>" class="properties-button <?php echo $active_class; ?>" data-type="<?php echo $key; ?>"><?php echo $item; ?></a>
                <?php endforeach; ?>
            </p>
        </div>
        <div class="row mt-1">
            <p class="col-12 ">
                <?php echo $count_posts; ?> Results
            </p>
        </div>
        <div class="row col-12 max-width">
            <div class="col-12  my-2  px-0 _load_more">
                <?php echo get_property_list( $data_posts ); ?>                
            </div>
        </div>
        <div class="up d-none"><img src="<?php echo get_template_directory_uri(); ?>/images/up.png" id="up" alt="up"></div>
    </div>
</main>

<?php get_footer(); ?>

