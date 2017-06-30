<?php
/**
 * Register a custom post type called "product".
 *
 * @see get_post_type_labels() for label keys.
 */
function nutralife_custom_posts() {
	$labels = array(
		'name'                  => _x( 'Products', 'Post type general name', 'nutralife_products' ),
		'singular_name'         => _x( 'Product', 'Post type singular name', 'nutralife_products' ),
		'menu_name'             => _x( 'Products', 'Admin Menu text', 'nutralife_products' ),
		'name_admin_bar'        => _x( 'Product', 'Add New on Toolbar', 'nutralife_products' ),
		'add_new'               => __( 'Add New', 'nutralife_products' ),
		'add_new_item'          => __( 'Add New Product', 'nutralife_products' ),
		'new_item'              => __( 'New Product', 'nutralife_products' ),
		'edit_item'             => __( 'Edit Product', 'nutralife_products' ),
		'view_item'             => __( 'View Product', 'nutralife_products' ),
		'all_items'             => __( 'All Products', 'nutralife_products' ),
		'search_items'          => __( 'Search Products', 'nutralife_products' ),
		'parent_item_colon'     => __( 'Parent Products:', 'nutralife_products' ),
		'not_found'             => __( 'No products found.', 'nutralife_products' ),
		'not_found_in_trash'    => __( 'No products found in Trash.', 'nutralife_products' ),
		'featured_image'        => _x( 'Product Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'nutralife_products' ),
		'set_featured_image'    => _x( 'Set product image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'nutralife_products' ),
		'remove_featured_image' => _x( 'Remove product image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'nutralife_products' ),
		'use_featured_image'    => _x( 'Use as product image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'nutralife_products' ),
		'archives'              => _x( 'Product archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'nutralife_products' ),
		'insert_into_item'      => _x( 'Insert into product', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'nutralife_products' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this product', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'nutralife_products' ),
		'filter_items_list'     => _x( 'Filter products list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'nutralife_products' ),
		'items_list_navigation' => _x( 'Products list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'nutralife_products' ),
		'items_list'            => _x( 'Products list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'nutralife_products' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'product' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt'),
	);

	register_post_type( 'product', $args );
}

add_action( 'init', 'nutralife_custom_posts' );


add_action( 'init', 'nutralife_create_taxonomies', 0 );
function nutralife_create_taxonomies() {
	$labels = array(
		'name'              => _x( 'Product Categories', 'taxonomy general name', 'nutralife_products' ),
		'singular_name'     => _x( 'Product Category', 'taxonomy singular name', 'nutralife_products' ),
		'search_items'      => __( 'Search Product Categories', 'nutralife_products' ),
		'all_items'         => __( 'All Product Categories', 'nutralife_products' ),
		'parent_item'       => __( 'Parent Product Category', 'nutralife_products' ),
		'parent_item_colon' => __( 'Parent Product Category:', 'nutralife_products' ),
		'edit_item'         => __( 'Edit Product Category', 'nutralife_products' ),
		'update_item'       => __( 'Update Product Category', 'nutralife_products' ),
		'add_new_item'      => __( 'Add New Product Category', 'nutralife_products' ),
		'new_item_name'     => __( 'New Product Category Name', 'nutralife_products' ),
		'menu_name'         => __( 'Product Category', 'nutralife_products' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'product-categories' ),
	);
	register_taxonomy( 'product_cats', array( 'product' ), $args );

	$labels = array(
		'name'              => _x( 'Product Ingredients', 'taxonomy general name', 'nutralife_products' ),
		'singular_name'     => _x( 'Product Ingredient', 'taxonomy singular name', 'nutralife_products' ),
		'search_items'      => __( 'Search Product Ingredients', 'nutralife_products' ),
		'all_items'         => __( 'All Product Ingredients', 'nutralife_products' ),
		'parent_item'       => __( 'Parent Product Ingredient', 'nutralife_products' ),
		'parent_item_colon' => __( 'Parent Product Ingredient:', 'nutralife_products' ),
		'edit_item'         => __( 'Edit Product Ingredient', 'nutralife_products' ),
		'update_item'       => __( 'Update Product Ingredient', 'nutralife_products' ),
		'add_new_item'      => __( 'Add New Product Ingredient', 'nutralife_products' ),
		'new_item_name'     => __( 'New Product Ingredient Name', 'nutralife_products' ),
		'menu_name'         => __( 'Product Ingredient', 'nutralife_products' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'ingredient' ),
	);
	register_taxonomy( 'ingredient', array( 'product' ), $args );

	$labels = array(
		'name'              => _x( 'Health Concern', 'taxonomy general name', 'nutralife_products' ),
		'singular_name'     => _x( 'Health Concern', 'taxonomy singular name', 'nutralife_products' ),
		'search_items'      => __( 'Search Health Concern', 'nutralife_products' ),
		'all_items'         => __( 'All Health Concern', 'nutralife_products' ),
		'parent_item'       => __( 'Parent Health Concern', 'nutralife_products' ),
		'parent_item_colon' => __( 'Parent Health Concern:', 'nutralife_products' ),
		'edit_item'         => __( 'Edit Health Concern', 'nutralife_products' ),
		'update_item'       => __( 'Update Health Concern', 'nutralife_products' ),
		'add_new_item'      => __( 'Add New Health Concern', 'nutralife_products' ),
		'new_item_name'     => __( 'New Health Concern Name', 'nutralife_products' ),
		'menu_name'         => __( 'Health Concern', 'nutralife_products' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'health-concern' ),
	);
	register_taxonomy( 'health_concern', array( 'product' ), $args );
}