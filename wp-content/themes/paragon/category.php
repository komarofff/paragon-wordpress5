
<?php get_header(); ?>


<div class="col-lg-12 mb-3 page-content">	

	<h1 class="text-muted mb-4">			
		<?php single_cat_title( '', true ); ?>
	</h1>

	<?php
	// global $wp_query;
	// p_arr($wp_query);
	$terms = get_term_children( $wp_query->queried_object->term_id, 'category' );	
	?>

	<?php if ( count($terms) ): ?>

		<?php foreach($terms as $id_cat): ?>
			<p class="h4"><a href="<?php echo get_category_link($id_cat) ?>"><?php echo get_cat_name($id_cat) ?></a></p>
		<?php endforeach; ?>

	<?php else: ?>

		<?php if ( have_posts() ) : ?>

			<?php		
			while ( have_posts() ) :				
				the_post();
				get_template_part( 'template-parts/content', get_post_format() );
			endwhile;
			?>
			
			<?php echo get_theme_pagination(); ?>
			
		<?php
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>

	<?php endif; ?>		

			

</div>


<?php get_footer(); ?>