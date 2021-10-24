<?php get_header(); ?>

    <div class="col-lg-12 mb-3 page-content">
    <div class="container  mb-3 page-content">
        <?php

        while (have_posts()) :


            the_post();
            // Include the page content template.
            get_template_part('template-parts/content', 'single');

        endwhile;

        ?>

    </div>
    </div>

<?php get_footer(); ?>