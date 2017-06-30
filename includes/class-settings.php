<?php

if ( !class_exists('Nutralife_Product_Settings' ) ):
	class Nutralife_Product_Settings {

		private $settings_api;

		function __construct() {
			$this->settings_api = new WeDevs_Settings_API;

			add_action( 'admin_init', array($this, 'admin_init') );
			add_action( 'admin_menu', array($this, 'admin_menu') );
		}

		function admin_init() {

			//set the settings
			$this->settings_api->set_sections( $this->get_settings_sections() );
			$this->settings_api->set_fields( $this->get_settings_fields() );

			//initialize settings
			$this->settings_api->admin_init();
		}

		function admin_menu() {
			add_submenu_page('edit.php?post_type=product', __('Settings', 'nutralife_products'), __('Settings', 'nutralife_products'), 'manage_options', 'nutralife_products', array(&$this, 'plugin_page'));
		}

		function get_settings_sections() {
			$sections = array(
				array(
					'id'    => 'categories',
					'title' => __( 'Category Settings', 'nutralife_products' )
				),
				array(
					'id'    => 'health_concern',
					'title' => __( 'Health Concern', 'nutralife_products' )
				),
				array(
					'id'    => 'ingredient',
					'title' => __( 'Ingredient', 'nutralife_products' )
				)

			);
			return $sections;
		}

		/**
		 * Returns all the settings fields
		 *
		 * @return array settings fields
		 */
		function get_settings_fields() {
			$settings_fields = array(
				'categories' => array(
					array(
						'name'              => 'category_banner_title',
						'label'             => __( 'Category Title', 'nutralife_products' ),
						'desc'              => __( 'Title of banner', 'nutralife_products' ),
						'placeholder'       => __( 'Categories', 'nutralife_products' ),
						'type'              => 'text',
						'sanitize_callback' => 'sanitize_text_field'
					),
					array(
						'name'        => 'category_banner_desc',
						'label'       => __( 'Category Description', 'wedevs' ),
						'desc'        => __( 'Description of the category. that will appear on the banner.', 'nutralife_products' ),
						'type'        => 'textarea'

					),
					array(
						'name'    => 'category_banner_image',
						'label'   => __( 'Category Banner', 'nutralife_products' ),
						'desc'    => __( 'Select category banner image', 'nutralife_products' ),
						'type'    => 'file',
						'default' => '',
						'options' => array(
							'button_label' => 'Choose Image'
						)
					)
				),
				'health_concern' => array(
					array(
						'name'              => 'health_concern_banner_title',
						'label'             => __( 'Health Concern Title', 'nutralife_products' ),
						'desc'              => __( 'Title of banner', 'nutralife_products' ),
						'type'              => 'text',
						'sanitize_callback' => 'sanitize_text_field'
					),
					array(
						'name'        => 'health_banner_desc',
						'label'       => __( 'Health Concern Description', 'wedevs' ),
						'desc'        => __( 'Description of the Health Concern. that will appear on the banner.', 'nutralife_products' ),
						'type'        => 'textarea'
					),
					array(
						'name'    => 'health_concern_banner_image',
						'label'   => __( 'Health Concern Banner', 'nutralife_products' ),
						'desc'    => __( 'Select health concern banner image', 'nutralife_products' ),
						'type'    => 'file',
						'default' => '',
						'options' => array(
							'button_label' => 'Choose Image'
						)
					)
				),
				'ingredient' => array(
					array(
						'name'              => 'ingredient_banner_title',
						'label'             => __( 'Title', 'nutralife_products' ),
						'desc'              => __( 'Title of banner', 'nutralife_products' ),
						'type'              => 'text',
						'sanitize_callback' => 'sanitize_text_field'
					),
					array(
						'name'        => 'ingredient_banner_desc',
						'label'       => __( 'Ingredient Description', 'nutralife_products' ),
						'desc'        => __( 'Description of the Ingredient. that will appear on the banner.', 'nutralife_products' ),
						'type'        => 'textarea'
					),
					array(
						'name'    => 'ingredient_banner_image',
						'label'   => __( 'Ingredient Banner Image', 'nutralife_products' ),
						'desc'    => __( 'Select Ingredient banner image', 'nutralife_products' ),
						'type'    => 'file',
						'default' => '',
						'options' => array(
							'button_label' => 'Choose Image'
						)
					)
				),
			);

			return $settings_fields;
		}

		function plugin_page() {
			echo '<div class="wrap">';

			$this->settings_api->show_navigation();
			$this->settings_api->show_forms();

			echo '</div>';
		}

		/**
		 * Get all the pages
		 *
		 * @return array page names with key value pairs
		 */
		function get_pages() {
			$pages = get_pages();
			$pages_options = array();
			if ( $pages ) {
				foreach ($pages as $page) {
					$pages_options[$page->ID] = $page->post_title;
				}
			}

			return $pages_options;
		}

	}
endif;

new Nutralife_Product_Settings();