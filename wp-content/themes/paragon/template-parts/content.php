
<div class="mb-3">

	<div class="row">
		<?php if( has_post_thumbnail() ): ?>
		<div class="col-md-4">
			<?php the_post_thumbnail('medium'); ?>
		</div>
		<div class="col-md-8">
			<div>
				<?php the_title( sprintf( '<h2 class="h4"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</div>
			<!-- <div class="mb-2">
				<?php //the_date( '', '', '', true ); ?>
			</div> -->
			<div><?php the_excerpt(); ?></div>
		</div>
		<?php else: ?>
			<div class="col-md-12">
				<div>
					<?php the_title( sprintf( '<h2 class="h4"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				</div>
				<!-- <div class="mb-2">
					<?php //the_date( '', '', '', true ); ?>
				</div> -->
				<!-- <div><?php the_excerpt(); ?></div> -->
			</div>
		<?php endif; ?>	
	</div>
		
</div>
