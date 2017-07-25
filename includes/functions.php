<?php
// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

function nutralife_get_term_related_blogs($term_id, $taxonomy){
	if(!$term_id){
		return new WP_Error('no-term-id-received', 'No term id received');
	}

	if(!$taxonomy){
		return new WP_Error('no-taxonomy-received', 'No taxonomy  received');
	}

	$the_query = new WP_Query( array(
		'post_type' => 'post',
		'tax_query' => array(
			array (
				'taxonomy' => $taxonomy,
				'field' => 'term_id',
				'terms' => $term_id,
			)
		),
	) );

	wp_reset_postdata();
	if(isset($the_query->posts) && is_array($the_query->posts) && !empty($the_query->posts)){
		return wp_list_pluck($the_query->posts, 'ID');

	}else{
		return false;
	}
}


function nutralife_get_option( $option, $section, $default = '' ) {

	$options = get_option( $section );

	if ( isset( $options[$option] ) ) {
		return $options[$option];
	}

	return $default;
}
add_action( 'pre_get_posts', 'custom_pre_get_posts' );

function custom_pre_get_posts( $query ) {
	if ( is_admin() or ! $query->is_main_query() )
		return;

	if ( is_tax(['product_cats', 'ingredient', 'health_concern']) ) {
		$query->set( 'post_type',  'product' );
	}

}


function nutralife_get_popular_tax($tax='product_cats'){
	$categories = get_terms( $tax, array(
		'hide_empty' => false,
	) );

	$result = array();
	foreach ( $categories as $term ) {
		$popular = get_term_meta($term->term_id, 'popular', true );
		if($popular !== '1') continue;
		$order = get_term_meta($term->term_id, 'order', true );
		$result[$order] = $term;
	}
	ksort( $result, SORT_NUMERIC );
	return array_slice($result, 0, 6);
}

function nutralife_get_non_popular_tax($tax='product_cats'){
	$categories = get_terms( $tax, array(
		'hide_empty' => false,
	) );

    $result = array();
    foreach ( $categories as $term ) {
        $popular = get_term_meta($term->term_id, 'popular', true );
        if($popular == '1') continue;
//		$order = get_term_meta($term->term_id, 'order', true );
        $result[] = $term;
    }
////	ksort( $result, SORT_NUMERIC );
    return $result;
}


add_shortcode('nutralife_popular_taxonomy', 'nutralife_popular_taxonomy_callback');
function nutralife_popular_taxonomy_callback() {
	include NTLFP_TEMPLATES_DIR .'/popular-taxonomy.php';
}
