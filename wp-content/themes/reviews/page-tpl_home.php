<?php
/*
	Template Name: Home Page
*/

get_header();
the_post();
$permalink = reviews_get_permalink_by_tpl( 'page-tpl_search' );
$slider = '';

global $reviews_slugs;

for( $i=1; $i<=5; $i++ ){
	$image_data = reviews_get_option( 'home_bs_img_'.$i );
	if( !empty( $image_data['url'] ) ){
		$slider .= '<li><img data-src="'.esc_url( $image_data['url'] ).'" src="'.get_template_directory_uri().'/images/holder.jpg" class="reviews-lazy-load" width="'.esc_attr( $image_data['width'] ).'" height="'.esc_attr( $image_data['height'] ).'" alt=""></li>';
	}
}
?>
	<h1 style='color:rgba(255,255,255,0); z-index:5; position:absolute;'>Welcome to Range Hood Reviews! We review all manner of range hoods and kitchen appliances so you don't have to! Start searching below.</h1>

<section class="big-search">
	<ul class="list-unstyled big-search-slider">
		<?php echo $slider ?>
	</ul>
	<div class="big-search-overlay"></div>
	<div class="container">
		<form method="get" action="<?php echo esc_url( $permalink ) ?>">
			<h1>Search Range Hood Models</h1>
			<h2>Quickly Find User Reviews on Range Hoods You're Interested In</h2>
			<input type="text" name="<?php echo esc_attr( $reviews_slugs['keyword'] ); ?>" id="keyword" value="" />
			<a href="javascript:;" class="submit-live-form">
				<?php esc_html_e( 'Search', 'reviews' ) ?>
			</a>
		</form>
	</div>
</section>
<section>
	<div class="container">
	<h1 style='color:rgba(255,255,255,0); z-index:5; position:absolute;'>Welcome to Range Hood Reviews! We review all manner of range hoods and kitchen appliances so you don't have to! Start searching below.</h1>
		<?php the_content(); ?>
	</div>
</section>

<?php get_footer(); ?>
