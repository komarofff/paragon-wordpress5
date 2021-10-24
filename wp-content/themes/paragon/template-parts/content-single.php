	
<div class="mb-2 font-size-90">	
	<?php echo get_the_category_list( ' / ', 'multiple', $post->ID ); ?>		
</div>	

<div class="mb-4">
	<?php the_title( '<h1>', '</h1>' ); ?>
</div>

<!-- <div class="mb-2">
	<?php //the_date( '', '', '', true ); ?>
</div> -->

<div>
	
	<?php if( has_post_thumbnail() ): ?>
		<div class="mb-3">
			<?php the_post_thumbnail( 'full' ); ?>				
		</div>
	<?php endif; ?>

	<div class="entry">
		<?php the_content(); ?>
	</div>	

</div>
