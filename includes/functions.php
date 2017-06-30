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