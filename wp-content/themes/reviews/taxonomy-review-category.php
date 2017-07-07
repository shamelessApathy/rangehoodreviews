<?php
/*=============================
	DEFAULT BLOG LISTING PAGE
=============================*/
get_header();
get_template_part( 'includes/title' );
global $wp_query;

$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page
$page_links_total =  $wp_query->max_num_pages;
$page_links = paginate_links( 
	array(
		'base' => esc_url( add_query_arg( 'paged', '%#%' ) ),
		'prev_next' => true,
		'end_size' => 2,
		'mid_size' => 2,
		'total' => $page_links_total,
		'current' => $cur_page,	
		'prev_next' => false,
		'type' => 'array'
	)
);	
$pagination = reviews_format_pagination( $page_links );


?>
<section>
	<div class="container">
		<div class="row">

			<div class="col-sm-<?php echo is_active_sidebar( 'reviews-search' ) ? esc_attr( '9' ) : esc_attr( '12' ) ?>">
				<?php if( have_posts() ): ?>
					<div class="row masonry">
						<?php
						while( have_posts() ){
							the_post();
							echo '<div class="col-sm-'.( is_active_sidebar( 'reviews-search' ) ? esc_attr( '6' ) : esc_attr( '4' ) ).' masonry-item">';
								 include( reviews_load_path( 'includes/review-box.php' ) );
							echo '</div>';
						}
						?>
					</div>
					<?php if( !empty( $pagination ) ): ?>
						<div class="pagination">
							<?php echo  $pagination; ?>
						</div>	
					<?php endif; ?>
				<?php else: ?>
					<div class="widget white-block">
						<?php esc_html_e( 'No reviews found to match your search criteria', 'reviews' ); ?>
					</div>
				<?php endif; ?>			
			</div>

			<?php get_sidebar( 'reviews-search' ); ?>		
		</div>		
	</div>
</section>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>