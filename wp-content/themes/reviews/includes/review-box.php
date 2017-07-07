<div class="b-reviews">
	<div class="b-reviews-image">
		<?php
		$image_size = 'reviews-box-thumb';
		add_filter( 'wp_get_attachment_image_attributes', 'reviews_lazy_load_product_images');
		include( reviews_load_path( 'media/media.php' ) );
		remove_filter( 'wp_get_attachment_image_attributes', 'reviews_lazy_load_product_images');
		$post_id = get_the_ID();
		?>
	</div>
	<div class="content-inner">
	<a href="<?php the_permalink() ?>" class="blog-title">
			<h5><?php the_title() ?></h5>
		</a>
		<div class="ratings clearfix">
			<?php echo reviews_calculate_ratings(); ?>
		</div>

		

		<?php the_excerpt(); ?>

		<div class="avatar">
			<div class="clearfix">		
				<div class="pull-left">
					<?php
					$avatar_url = reviews_get_avatar_url( get_avatar( get_the_author_meta('ID'), 25 ) );
					if( !empty( $avatar_url ) ):
					?>
						<img src="<?php echo esc_url( $avatar_url ) ?>" alt="author" width="25" height="25"/>
					<?php endif; ?>					
					<?php
					$direction = reviews_get_option( 'direction' );
					if( $direction == 'ltr' ){
						esc_html_e( 'By ', 'reviews' );
					}
					?>
					<a href="<?php echo esc_url( add_query_arg( array( 'post_type' => 'review' ), get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ) ?>">
						<?php echo get_the_author_meta( 'display_name' ); ?>						
					</a>
					<?php
					if( $direction == 'rtl' ){
						esc_html_e( ' By', 'reviews' );
					}
					?>
				</div>
				<div class="pull-right reviews-box-cat">
					<?php reviews_review_category(); ?>
				</div>
			</div>
		</div>			
	</div>
</div>