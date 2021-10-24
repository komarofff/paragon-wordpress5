<?php get_header(); ?>
<?php get_sidebar(); ?>

<div class="col-lg-9 mb-3 page-content">

		<?php if ( have_posts() ) : ?>			

			<div>
				<p><?php printf( __( 'Результат для: %s' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></p>
			</div>			

			<?php			
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'search' );
			endwhile;
			
			the_posts_pagination(
				array(
					'prev_text'          => '&laquo;',
					'next_text'          => '&raquo;',
					'before_page_number' => '',					
				)
			);			
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
		
</div>


<?php get_footer(); ?>