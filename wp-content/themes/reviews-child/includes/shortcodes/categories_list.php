<?php
function reviews_categories_func( $atts, $content ){
	extract( shortcode_atts( array(
		'categories' => '',
		'num_subs' => '',
		'link_to_subcats' => 'no'
	), $atts ) );

	$permalink = reviews_get_permalink_by_tpl( 'page-tpl_search' );
	if( $link_to_subcats == 'yes' ){
		$permalink_cats = reviews_get_permalink_by_tpl( 'page-tpl_all_categories' );
	}

	if( empty( $categories ) ){
		$categories = get_terms( 'review-category', array( 'parent' => 0, 'hide_empty' => false ) );
	}
	else{
		$categories = explode(",", $categories);
		$categories = get_terms( 'review-category', array( 'include' => $categories, 'hide_empty' => false ) );
	}

	ob_start();
	?>
	<div class="row category-list">
		<?php
        $counter = 0;		
		foreach( $categories as $category ){
            if( $counter == 3 ){
                echo '</div><div class="row category-list">';
                $counter = 0;
            }
            $counter++;			
			$term_meta = get_option( "taxonomy_".$category->term_id );
			$value = !empty( $term_meta['category_icon'] ) ? $term_meta['category_icon'] : '';

			$has_children = false;
			if( $link_to_subcats == 'yes' ){
				$children = get_terms( 'review-category', array( 'hide_empty' => false, 'number' => $num_subs, 'parent' => $category->term_id ) );
				if( !empty( $children ) ){
					$has_children = true;
				}
			}
			?>
			


					<a href="<?php echo esc_url( add_query_arg( array( 'review-category' => $category->slug ), $has_children ? $permalink_cats : $permalink ) ); ?>" title="<?php echo esc_attr( $category->name ); ?>" class="leading-category clearfix">
						<i class="fa fa-<?php echo esc_attr( $value ); ?>"></i> <?php echo !empty( $value ) ? '<span class="category-lead-bg"></span>' : '' ?> 
				<div class='brand-box'>
					     <div class='brand-image'>
					     <?php echo do_shortcode(sprintf('[wp_custom_image_category term_id="%s"]',$category->term_id));?>
					     </div>
					     <div class='brand-info'>
					     <div class='brand-name'>
					    <span style='float:left'> <?php echo $category->name; ?></span>
					     
					     	<span style='font-size:9px;float:left;padding-top:2px;margin-left:25px;'> <?php echo 'Reviews:'.' '. $category->count; ?>
					     	</span>
					     	<span style='font-size:9px;float:right;'>Used this brand before? Write a review!</span>
					     </div>
					     </div>
				</div>
					</a>			  	
			
			<?php
		}
		?>
	<?php
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

add_shortcode( 'categories_list', 'reviews_categories_func' );

function reviews_categories_list_params(){
	return array(
		array(
			"type" => "multidropdown",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Categories","reviews"),
			"param_name" => "categories",
			"value" => reviews_get_taxonomy_list( 'review-category', 'left' ),
			"description" => esc_html__("Select parent categories to show.","reviews")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Number Of Subcategories","reviews"),
			"param_name" => "num_subs",
			"value" => '',
			"description" => esc_html__("Input number of subcategories to show under each category. Input 0 For all.","reviews")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__("Link To Subcategories","reviews"),
			"param_name" => "link_to_subcats",
			"value" => array(
				esc_html__( 'No', 'reviews' ) => 'no',
				esc_html__( 'Yes', 'reviews' ) => 'yes',
			),
			"description" => esc_html__("If this is set to yes then if category has subcategories link will go there instead on filter reviews.","reviews")
		),
	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => esc_html__("Reviews Categories", 'reviews'),
	   "base" => "categories_list",
	   "category" => esc_html__('Content', 'reviews'),
	   "params" => reviews_categories_list_params()
	) );
}
?>
