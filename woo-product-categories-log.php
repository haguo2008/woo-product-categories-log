<?php
/**
 * Plugin Name: WooCommerce 产品分类目录
 * Description: 产品页面显示产品分类目录
 */
?>
<?php
add_action( 'wp_enqueue_scripts', 'woo_product_categories_css' );
function woo_product_categories_css() {
    wp_register_style( 'woo_product_categories_css', plugins_url( 'css/style.css', __FILE__ ) );
    wp_enqueue_style( 'woo_product_categories_css' );
}
 
add_action( 'woocommerce_before_shop_loop', 'woo_product_subcategories', 50 );
function woo_product_subcategories( $args = array() ) {
	global $wp;
	$woocommerce_category_id = get_terms('product_type');
	echo '<div class="section section-filters">';
	echo '<div class="section_wrapper clearfix"> <!-- #Filters -->';
	echo '<div id="Filters" class="column one ">';
	echo '<ul class="filters_buttons">';
	echo '<li class="label">Filter by</li>';
	echo '<li class="categories"><a class="open" href="#"><i class="icon-docs"></i>Product Categories</a></li>';
	echo '</ul>';
		foreach ($woocommerce_category_id as $term) {
			 
			$args = array( 'parent' => $woocommerce_category_id ->term_id );
			$terms = get_terms( 'product_cat', $args );
			 if ( $terms ) {
				echo '<div class="filters_wrapper">';
				echo '<ul class="categories">';
				echo '<li class="reset-inner"><a data-rel="*" href="'.home_url( $wp->request.'/' ).'">All</a></li>';
			foreach ( $terms as $term ) {
					  //var_dump($term->count);
				echo '<li class="woocommerce-product-category-page">';
				echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">';
				echo $term->name;
				echo '</a>';
				echo '</li>';
			}
				echo '<li class="close"><a href="#"><i class="icon-cancel"></i></a></li>';
				echo '</ul>';
				echo '</div>';
		}

	}
	 echo '</div>';
	 echo '</div>';
	 echo '</div>';
}
	 
	 