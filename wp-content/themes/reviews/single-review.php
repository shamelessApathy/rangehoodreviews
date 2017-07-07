<?php
/*=============================
	DEFAULT SINGLE
=============================*/
get_header();
global $reviews_microdata_review;
$reviews_microdata_review = array();

reviews_count_clicks();
$post_pages = wp_link_pages( 
	array(
		'before' => '',
		'after' => '',
		'link_before'      => '<span>',
		'link_after'       => '</span>',
		'next_or_number'   => 'number',
		'nextpagelink'     => esc_html__( '&raquo;', 'reviews' ),
		'previouspagelink' => esc_html__( '&laquo;', 'reviews' ),			
		'separator'        => ' ',
		'echo'			   => 0
	) 
);

$permalink = reviews_get_permalink_by_tpl( 'page-tpl_search' );

$user_reviews = get_post_meta( get_the_ID(), 'user_ratings_count', true );
if( empty( $review_count ) ){
	$review_count = 0;
}

$user_average = get_post_meta( get_the_ID(), 'user_average', true );
if( empty( $user_average ) ){
	$user_average = 0.0;
}

$featured_image_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
$pager = '';


global $reviews_user_overall;;
ob_start();
comments_template( '', true );
$comments_template = ob_get_contents();
ob_end_clean();

?>
<section class="single-blog">
	<input type="hidden" name="post-id" value="<?php the_ID() ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-9">

				<div class="blog-media">
					<ul class="list-unstyled review-slider">
						<?php 
						$pager = '';
						if( has_post_thumbnail() ): ?>
							<li>
								
							<?php
							$pager .= '<li>'.get_the_post_thumbnail( get_the_ID(), 'thumbnail' ).'</li>';
							?>
						<?php endif; ?>
						<?php
						$review_images = get_post_meta( get_the_ID(), 'review_images' );
						if( !empty($review_images) ){
							foreach( $review_images as $review_image ){
								echo '<li>';
									reviews_single_review_slider_images( $review_image );
								echo '</li>';
								add_filter( 'wp_get_attachment_image_attributes', 'reviews_lazy_load_product_images');
								$pager .= '<li>'.wp_get_attachment_image( $review_image, 'thumbnail' ).'</li>';
								remove_filter( 'wp_get_attachment_image_attributes', 'reviews_lazy_load_product_images');
							}
						}
						else{
							$pager = '';
						}
						?>
					</ul>
					<?php if( !empty( $pager ) ): ?>
						<ul class="slider-pager list-unstyled list-inline">
							<?php echo  $pager; ?>
						</ul>
					<?php endif; ?>
				</div>

				<?php
				$review_tabs = get_post_meta( get_the_ID(), 'review_tabs' );
				$titles_html = '';
				$contents_html = '';
				if( !empty( $review_tabs[0] ) ){
					$titles_html .= '<li role="presentation" class="active"><a href="#tab_0" role="tab" data-toggle="tab">'.esc_html__( 'Our Analysis', 'reviews' ).'</a></li>';
					for( $i=0; $i<sizeof( $review_tabs ); $i++ ){
						$titles_html .= '<li role="presentation"><a href="#tab_'.esc_attr( $i+1 ).'" role="tab" data-toggle="tab">'.$review_tabs[$i]['review_tab_title'].'</a></li>';
						$contents_html .= '<div role="tabpanel" class="tab-pane" id="tab_'.esc_attr( $i+1 ).'"><div class="white-block single-item"><div class="content-inner">'.( !empty( $review_tabs[$i]['review_tab_content'] ) ? apply_filters( 'the_content', $review_tabs[$i]['review_tab_content'] ) : '' ).'</div></div></div>';
					}
				}
				?>
				<ul class="nav nav-tabs review-tabs-btns" role="tablist">
					<?php echo  $titles_html ?>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content review-tabs">
					<div role="tabpanel" class="tab-pane in active" id="tab_0">
						<div class="white-block single-item">
							<div class="content-inner">

								<h1 class="post-title size-h3"><?php the_title() ?></h1>
								
								<div class="post-content clearfix">
									<?php the_content(); ?>							
								</div>
								
							</div>
						</div>
					</div>
					<?php echo  $contents_html; ?>
				</div>

				<?php
				$review_pros = get_post_meta( get_the_ID(), 'review_pros' );
				$review_cons = get_post_meta( get_the_ID(), 'review_cons' );
				if( !empty( $review_pros ) || !empty( $review_cons ) ):
				?>
				<div class="white-block pros-cons">
					<div class="content-inner">			
						<!-- title -->
						<div class="widget-title-wrap">
							<h5 class="widget-title">
								<?php esc_html_e( 'Pros And Cons', 'reviews' ); ?>
							</h5>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<ul class="list-unstyled">
								<?php 
								if( !empty( $review_pros ) ){
									foreach( $review_pros as $review_pro ){
										echo '<li><i class="fa fa-plus-square-o"></i> '.$review_pro.'</li>';
									}
								}
								?>
								</ul>
							</div>
							<div class="col-sm-6">
								<ul class="list-unstyled">
								<?php 
								if( !empty( $review_cons ) ){
									foreach( $review_cons as $review_con ){
										echo '<li><i class="fa fa-minus-square-o"></i> '.$review_con.'</li>';
									}
								}
								?>
								</ul>
							</div>							
						</div>


					</div>
				</div>
				<?php endif; ?>

				<?php
				$reviews_score = get_post_meta( get_the_ID(), 'reviews_score' );
				if( !empty( $reviews_score ) ):
				?>
				<div class="white-block score-breakdown">
					<div class="content-inner">			
						<!-- title -->
						<div class="widget-title-wrap">
							<h5 class="widget-title">
								<?php esc_html_e( 'Author\'s Review Score Breakdown', 'reviews' ); ?>
							</h5>
						</div>
						<ul class="list-unstyled ordered-list">
							<?php
							foreach( $reviews_score as $reviews_score_item ){
								?>
								<li>
									<?php echo  $reviews_score_item['review_criteria']; echo ':'; ?>
									<span class="value author-ratings">
										<?php reviews_rating_display( $reviews_score_item['review_score'] ); ?>
									</span>
								</li>
								<?php
							}
							?>
							<li>
								<strong><?php esc_html_e( 'Overall', 'reviews' ) ?>:</strong>
								<span class="value author-ratings">
									<?php 
									$author_average = get_post_meta( get_the_ID(), 'author_average', true );
									reviews_rating_display( $author_average );
									?>
								</span>
							</li>
						</ul>

					</div>
				</div>
				<?php endif; ?>

				<?php
				$comment_number = get_comments_number();
				if( $comment_number > 0 && comments_open() ):
				?>
					<div class="white-block score-breakdown">
						<div class="content-inner">			
							<!-- title -->
							<div class="widget-title-wrap">
								<h5 class="widget-title">
									<?php esc_html_e( 'Users\'s Overal Review Score Breakdown', 'reviews' ); ?>
								</h5>
							</div>
							<ul class="list-unstyled ordered-list">
								<?php
								$counter = 0;
								
								foreach( $reviews_score as $reviews_score_item ){
									?>
									<li>
										<?php echo  $reviews_score_item['review_criteria']; echo ':'; ?>
										<span class="value user-ratings">
											<?php reviews_rating_display( $reviews_user_overall[$counter] / $comment_number );  ?>
										</span>
									</li>
									<?php
									$counter++;
								}
								?>
								<li>
									<strong><?php esc_html_e( 'Overall', 'reviews' ) ?>:</strong>
									<span class="value user-ratings">
										<?php reviews_rating_display( $user_average ); ?>
									</span>
								</li>
							</ul>

						</div>
					</div>
				<?php endif; ?>

				<?php 
				$tags = reviews_custom_tax( 'review-tag' );
				if( !empty( $tags ) ):
				?>
					<div class="post-tags white-block">
						<div class="content-inner">
							<i class="fa fa-tags"></i> 
							<?php esc_html_e( 'Tags: ', 'reviews' ); echo  $tags; ?>
						</div>
					</div>
				<?php
				endif;
				?>				
						
				<?php echo $comments_template; ?>

			</div>
			<div class="col-md-3">
				<div class="widget white-block clearfix">
					<ul class="list-unstyled ordered-list">
						<?php
						$reviews_show_author = reviews_get_option( 'reviews_show_author' );
						if( $reviews_show_author == 'yes' ):
						?>
							<li class="reviews-avatar">
								<?php
								$avatar_url = reviews_get_avatar_url( get_avatar( get_the_author_meta('ID'), 50 ) );
								if( !empty( $avatar_url ) ):
								?>
									<a href="<?php echo esc_url( add_query_arg( array( 'post_type' => 'review' ), get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ); ?>">
										<img src="<?php echo esc_url( $avatar_url ) ?>" class="img-responsive" alt="author"/>
									</a>
								<?php
								endif;
								?>						
								<?php esc_html_e( 'By ', 'reviews' ) ?><a href="<?php echo esc_url( add_query_arg( array( 'post_type' => 'review' ), get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ); ?>"> <?php echo get_the_author_meta('display_name'); ?></a>
							</li>
						<?php endif; ?>
						<li>
							<?php esc_html_e( 'Category:', 'reviews' ) ?>
							<span class="value"><?php echo reviews_review_category(); ?></span>
						</li>
						<li>
							<?php esc_html_e( 'Author Ratings:', 'reviews' ) ?>
							<span class="value author-ratings">
								<?php 
									$author_average = get_post_meta( get_the_ID(), 'author_average', true );
									reviews_rating_display( $author_average );
								?>
							</span>
						</li>
						<?php if( comments_open() ): ?>
						<li>
							<?php esc_html_e( 'User Ratings:', 'reviews' ) ?>
							<span class="value user-ratings">
								<?php reviews_rating_display( $user_average );?>
							</span>
						</li>
						<li>
							<?php esc_html_e( 'Reviews:', 'reviews' ) ?>
							<span class="value">
								<?php
								$reviews_count = reviews_display_count_reviews( get_the_ID() );
								echo  $reviews_count.' '.( $reviews_count == 1 ? esc_html__( 'user review', 'reviews' ) : esc_html__( 'user reviews', 'reviews' ) );
								?>
							</span>
						</li>
						<?php endif;?>
						<li>
							<?php esc_html_e( 'Created:', 'reviews' ) ?>
							<span class="value"><?php the_time( 'F j, Y' ) ?></span>
						</li>
					</ul>
					<?php
					$review_cta_text = reviews_get_option( 'reviews_cta_text' );
					$review_cta_link = get_post_meta( get_the_ID(), 'review_cta_link', true );
					if( !empty( $review_cta_link ) ){
						echo '<a href="'.esc_attr( $review_cta_link ).'" class="review-cta btn" target="_blank"><strong>'.$review_cta_text.'</strong></a>';
					}
					?>
				</div>

				<?php
				$reviews_wtb = get_post_meta( get_the_ID(), 'reviews_wtb' );
				if( !empty( $reviews_wtb ) ){
					?>
					<div class="widget white-block clearfix">
						<div class="widget-title-wrap">
							<h5 class="widget-title">
								<i class="fa fa-angle-double-right"></i><?php esc_html_e( 'Where To Buy', 'reviews' ) ?>
							</h5>
						</div>
						<ul class="list-unstyled reviews-wtb">
							<?php
							foreach( $reviews_wtb as $reviews_wtb_item ){
								?>
								<li>
									<a title="<?php echo esc_attr( $reviews_wtb_item['review_wtb_store_name'] ); ?>" href="<?php echo esc_url( $reviews_wtb_item['review_wtb_store_link'] ) ?>" class="store-logo" target="_blank">
										<?php echo wp_get_attachment_image( $reviews_wtb_item['review_wtb_store_logo'], 'full' ); ?>
									</a>

									<div class="clearfix">
										<?php
										$review_wtb_price = $reviews_wtb_item['review_wtb_price'];
										$review_wtb_sale_price = $reviews_wtb_item['review_wtb_sale_price'];
										if( !empty( $review_wtb_sale_price ) ){
											echo '<div class="pull-left price">'.$review_wtb_sale_price.'<span>'.$review_wtb_price.'</span></div>';
										}
										else{
											echo '<div class="pull-left price">'.$review_wtb_price.'</div>';	
										}

										$review_wtb_product_link = $reviews_wtb_item['review_wtb_product_link'];
										if( !empty( $review_wtb_product_link ) ){
											echo '<div class="pull-right price">
												<a href="'.esc_url( $review_wtb_product_link ).'" class="visit-store" target="_blank">'.__( 'Visit', 'reviews' ).' <i class="fa fa-external-link"></i></a>
											</div>';	
										}
										?>
									</div>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
					<?php
				}
				?>
				<?php
				$enable_share = reviews_get_option( 'enable_share' );
				if( $enable_share == 'yes' ):
				?>
					<div class="widget white-block clearfix">
						<div class="widget-title-wrap">
							<h5 class="widget-title">
								<i class="fa fa-angle-double-right"></i><?php esc_html_e( 'Share Review', 'reviews' ) ?>
							</h5>
						</div>				
						<?php get_template_part( 'includes/share' ) ?>
					</div>
				<?php endif; ?>


				<?php
				$similar_reviews_num = reviews_get_option( 'similar_reviews_num' );
				if( !empty( $similar_reviews_num ) && $similar_reviews_num > 0 ):
					$args = array(
						'post_type' => 'review',
						'posts_per_page' => $similar_reviews_num,
						'post__not_in' => array( get_the_ID() ),
						'post_status' => 'publish',
						'orderby' => 'rand'
					);
					$reviews_categories = get_the_terms( get_the_ID(), 'review-category' );
					if( !empty( $reviews_categories ) ){
						$cats = array();
						foreach( $reviews_categories as $reviews_category ){
							if( $reviews_category->parent == 0 ){
								$cats[] = $reviews_category->slug;	
							}
						}
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'review-category',
								'field' => 'slug',
								'terms' => $cats
							)
						);
					}
					
					$similar = new WP_Query( $args );
					if( $similar->have_posts() ):
					?>
						<div class="widget white-block clearfix">
							<div class="widget-title-wrap">
								<h5 class="widget-title">
									<i class="fa fa-angle-double-right"></i><?php esc_html_e( 'Similar Products', 'reviews' ) ?>
								</h5>
							</div>
							<ul class="list-unstyled similar-reviews">
								<?php
								while( $similar->have_posts() ){
									$similar->the_post();
									?>
									<li>
										<?php if( has_post_thumbnail() ): ?>
											<a href="<?php the_permalink() ?>" class="no-margin">
												<div class="embed-responsive embed-responsive-16by9">
													<?php 
													add_filter( 'wp_get_attachment_image_attributes', 'reviews_lazy_load_product_images');
													the_post_thumbnail( 'reviews-box-thumb', array( 'class' => 'embed-responsive-item' ) ); 
													remove_filter( 'wp_get_attachment_image_attributes', 'reviews_lazy_load_product_images');
													?>
												</div>
												<div class="ratings clearfix">
													<?php echo reviews_calculate_ratings(); ?>
												</div>
											</a>
										<?php else: ?>
											<div class="ratings clearfix">
												<?php echo reviews_calculate_ratings(); ?>
											</div>
										<?php endif; ?>
										<a href="<?php the_permalink() ?>" class="text-center">
											<h6><?php the_title(); ?></h6>
										</a>
									</li>
									<?php
								}
								?>
							</ul>
						</div>
					<?php endif; 
					wp_reset_postdata();
				endif;
				?>

				<?php get_sidebar( 'review' ); ?>
			</div>
		</div>
	</div>
</section>
<?php 

$average = $user_average;
if( empty( $average ) && !empty( $author_average ) ){
	$average = $author_average;
}
if( $average > 0 ): ?>
<script type="application/ld+json">
{
	"@context": "http://schema.org/",
	"@type": "Product",
	"aggregateRating": {
		"@type": "AggregateRating",
		"ratingValue": "<?php echo esc_html( $average ); ?>",
		"reviewCount": "1"
	},
	"image": "<?php echo !empty( $featured_image_data[0] ) ? esc_url( $featured_image_data[0] ) : ''; ?>",
	"name": "<?php the_title(); ?>",
	"review": [<?php echo join( ',', $reviews_microdata_review ) ?>]
}
</script>
<?php endif; ?>
<?php get_footer(); ?>