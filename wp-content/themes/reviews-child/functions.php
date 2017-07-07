<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
	.postbox.acf_postbox.no_box {
		background: rgba(0, 0, 0, 0.05);
		padding: 10px;
	}
  </style>';
}
?>
