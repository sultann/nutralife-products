<?php

add_filter( 'cmb2-taxonomy_meta_boxes', 'nutralife_tax_meta' );
function nutralife_tax_meta( array $meta_boxes ) {

	$style = true;
	if ( isset( $_GET['taxonomy'] ) ) {
		$style = false;
	}

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['taxonomy_metabox'] = array(
		'id'           => 'taxonomy_metabox',
		'title'        => __( 'Taxonomy Metabox', 'cmb2' ),
		'object_types' => array( 'health_concern', 'product_cats', 'ingredient' ), // Taxonomy
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'cmb_styles'   => $style, // false to disable the CMB stylesheet
		'fields'       => array(
			array(
				'name' => __( 'Hero Title', 'cmb2' ),
				'desc' => __( 'Enter a hero title here fo display on the on this taxonomy page, otherwise the main taxonomy name will be displayed', 'cmb2' ),
				'id'   => 'hero_title',
				'type' => 'text'
			),
			array(
				'name' => __( 'Taxonomy Thumbnail', 'cmb2' ),
				'desc' => __( 'This image will be shown as the image of the category in popular category section.', 'cmb2' ),
				'id'   => 'hero_image',
				'type' => 'file',
			),
			array(
				'name' => __( 'Hero Image', 'cmb2' ),
				'desc' => __( 'This image is shown across the top of this taxonomy page. If left blank, no image will be shown. SIZE 402X402px', 'cmb2' ),
				'id'   => 'hero_image',
				'type' => 'file',
			),

			array(
				'name'      => __( 'Hero Image Link', 'cmb2' ),
				'desc'      => __( 'Define a link here to make your hero image click able. If blank, the image will not be clickable', 'cmb2' ),
				'id'        => 'hero_link',
				'type'      => 'text_url',
				'protocols' => array( 'http', 'https' ), // Array of allowed protocols
			),
			array(
				'name' => __( 'Term SKU Image', 'cmb2' ),
				'desc' => __( 'Upload an image that will be used on popular taxonomy grid. SIZE 140x255px', 'cmb2' ),
				'id'   => 'term_sku',
				'type' => 'file',
			),

			array(
				'name'    => __( 'Order', 'cmb2' ),
				'desc'    => __( 'Numeric order for display on the listing', 'cmb2' ),
				'id'      => 'order',
				'default' => '0',
				'type'    => 'text'
			),
			array(
				'name'    => __( 'Is Popular', 'cmb2' ),
				'desc'    => __( 'If set to true, the taxonomy will be displayed as Most Popular on the parent taxonomy page.', 'cmb2' ),
				'id'      => 'popular',
				'type'    => 'select',
				'default' => '0',
				'options' => array(
					'1' => __( 'Yes', 'cmb2' ),
					'0' => __( 'No', 'cmb2' ),
				),
			),
		),
	);

	return $meta_boxes;
}


add_action( 'cmb2_admin_init', 'nutralife_product_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function nutralife_product_meta() {
	$style = true;
	if ( isset( $_GET['taxonomy'] ) ) {
		$style = false;
	}

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$metabox = new_cmb2_box( array(
		'id'           => 'product_details',
		'title'        => esc_html__( 'Product Details', 'cmb2' ),
		'object_types' => array( 'product' ), // Post type
		'priority'     => 'high',
		'cmb_styles'   => $style,
	) );


	$metabox->add_field( array(
		'name'      => esc_html__( 'Buy Now Link', 'cmb2' ),
		'desc'      => esc_html__( 'Add a link to an off page store to display a Buy Now button on the product page', 'cmb2' ),
		'id'        => 'buy_link',
		'type'      => 'text_url',
		'protocols' => array( 'http', 'https' ), // Array of allowed protocols
//		 'repeatable' => true,
	) );

	$metabox->add_field( array(
		'name' => esc_html__( 'Pack Size', 'cmb2' ),
		'desc' => esc_html__( 'Bold pack size text shown under the short description', 'cmb2' ),
		'id'   => 'pack_size',
		'type' => 'text'
	) );

	$metabox->add_field( array(
		'name'       => esc_html__( 'Features', 'cmb2' ),
		'desc'       => esc_html__( 'Shown as bold bullet point text under the product image on the product page', 'cmb2' ),
		'id'         => 'features',
		'type'       => 'text',
		'repeatable' => true,
	) );

	$metabox->add_field( array(
		'name'       => esc_html__( 'External Sources', 'cmb2' ),
		'desc'       => esc_html__( 'Shown as buttons under the product image on the product page. saperate text and link by pipe (|). e.g. See the science|http://example.com/somelink ', 'cmb2' ),
		'id'         => 'external_sources',
		'type'       => 'text',
		'repeatable' => true,
	) );

	$metabox->add_field( array(
		'name'    => __( 'Banner Type', 'cmb2' ),
		'desc'    => __( 'Select banner type image or revolution slider', 'cmb2' ),
		'id'      => 'banner_type',
		'type'    => 'select',
		'options' => array(
			'image'  => __( 'Image', 'cmb2' ),
			'slider' => __( 'Slider', 'cmb2' ),
		),
	) );
	$metabox->add_field( array(
		'name' => __( 'Banner Image', 'cmb2' ),
		'desc' => __( 'This image is shown on top of the product page if banner type is selected as image', 'cmb2' ),
		'id'   => 'banner_image',
		'type' => 'file',
	) );
	$metabox->add_field( array(
		'name' => esc_html__( 'Revolusion slide alias', 'cmb2' ),
		'desc' => esc_html__( 'Add a revolution slider alias to show on  the product page', 'cmb2' ),
		'id'   => 'slider_alias',
		'type' => 'text',
//		'protocols' => array('http', 'https'), // Array of allowed protocols
//		 'repeatable' => true,
	) );
}