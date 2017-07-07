<a href="javascript:;" class="to_top btn">
	<span class="fa fa-angle-up"></span>
</a>

<?php
get_sidebar( 'footer' );
?>

<?php
$copyrights = reviews_get_option( 'copyrights' );
$facebook_link = reviews_get_option( 'copyrights-facebook' );
$twitter_link = reviews_get_option( 'copyrights-twitter' );
$google_link = reviews_get_option( 'copyrights-google' );
$linkedin_link = reviews_get_option( 'copyrights-linkedin' );
$tumblr_link = reviews_get_option( 'copyrights-tumblr' );
if( !empty( $copyrights ) || !empty( $facebook_link ) || !empty( $twitter_link ) || !empty( $google_link ) || !empty( $linkedin_link ) || !empty( $tumblr_link ) ):
?>
	<section class="copyrights">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<p><?php                 
                        echo wp_kses_post( $copyrights );
					?></p>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
wp_footer();
?>
</body>
</html>