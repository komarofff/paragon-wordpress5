<?php get_header(); ?>

<main class="container-fluid mx-auto bg-light main-box ">



    <?php
    if(!is_page(17)){
        echo '<div class="container  mb-3 page-content">';
    }
    while (have_posts()) :

            the_post();

        // Include the page content template.
        get_template_part('template-parts/content', 'page');


    endwhile;
    if(!is_page(17)){
        echo '</div">';
    }
    ?>



</main>
<?php get_footer(); ?>

