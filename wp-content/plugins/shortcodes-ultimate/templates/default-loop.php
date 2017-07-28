<div class="su-posts su-posts-default-loop">
	<?php
		// Posts are found
		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) :
				$posts->the_post();
				global $post;
				?>

				<div id="su-post-<?php the_ID(); ?>" class="su-post">
					<?php if (!empty(the_post_thumbnail()) ) : ?>
						<a class="su-post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php endif; ?>
					<h2 class="su-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="su-post-meta"><?php _e( 'Posted', 'shortcodes-ultimate' ); ?>: <?php the_time( get_option( 'date_format' ) ); ?></div>
					<div class="su-post-excerpt">
						<?php the_excerpt(); ?>
					</div>
					<strong><?php esc_html_e( 'Overall', 'reviews' ) ?>:</strong>
						<span class="value author-ratings">
							<?php 
								$author_average = get_post_meta( get_the_ID(), 'author_average', true );
								reviews_rating_display( $author_average );
							?>
						</span>
					<a href="<?php comments_link(); ?>" class="su-post-comments-link"><?php comments_number( __( '0 comments', 'shortcodes-ultimate' ), __( '1 comment', 'shortcodes-ultimate' ), '% comments' ); ?></a>
				</div>

				<?php
			endwhile;
		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'shortcodes-ultimate' ) . '</h4>';
		}
	?>
</div>