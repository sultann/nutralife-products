<?php
/**
 * Plugin Name: Nutralife Products
 * Plugin URI:  http://manik.me
 * Description: The best WordPress plugin ever made!
 * Version:     0.1.0
 * Author:      MD Sultan N.
 * Author URI:  http://manik.me
 * Donate link: http://manik.me
 * License:     GPLv2+
 * Text Domain: nutralife_products
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2017 MD Sultan N. (email : manikdrmc@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Main initiation class
 */

class Nutralife_Products {

	public $version = '1.0.0';

	public $dependency_plugins = [];

	
	/**
	 * Sets up our plugin
	 * @since  0.1.0
	 */
	public function __construct() {

		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		add_action( 'admin_init', array( $this, 'admin_hooks' ) );
		add_action( 'init', [ $this, 'localization_setup' ] );
		$this->define_constants();
		$this->includes();
		add_action('wp_enqueue_scripts', [$this, 'load_assets']);
	}

	/**
	 * Activate the plugin
	 */
	function activate() {
		// Make sure any rewrite functionality has been loaded
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 */
	function deactivate() {

	}

	/**
	 * Initialize plugin for localization
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function localization_setup() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'nutralife_products' );
		load_textdomain( 'nutralife_products', WP_LANG_DIR . '/nutralife_products/nutralife_products-' . $locale . '.mo' );
		load_plugin_textdomain( 'nutralife_products', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}



	/**
	 * Hooks for the Admin
	 * @since  0.1.0
	 * @return null
	 */
	public function admin_hooks() {

	}

	/**
	 * Include a file from the includes directory
	 * @since  0.1.0
	 * @param  string $filename Name of the file to be included
	 */
	public function includes( ) {
		require NTLFP_INCLUDES .'/functions.php';
		require NTLFP_LIBS .'/CMB2/init.php';
		require NTLFP_LIBS .'/cmb2-taxonomy/init.php';
		require NTLFP_INCLUDES .'/cpt.php';
		require NTLFP_INCLUDES .'/metas.php';
		require NTLFP_INCLUDES .'/class-product.php';
		require NTLFP_INCLUDES .'/class-settings-api.php';
		require NTLFP_INCLUDES .'/class-settings.php';
	}


	/**
	 * Define Add-on constants
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	private function define_constants() {
		define( 'NTLFP_VERSION', $this->version );
		define( 'NTLFP_FILE', __FILE__ );
		define( 'NTLFP_PATH', dirname( NTLFP_FILE ) );
		define( 'NTLFP_INCLUDES', NTLFP_PATH . '/includes' );
		define( 'NTLFP_URL', plugins_url( '', NTLFP_FILE ) );
		define( 'NTLFP_ASSETS', NTLFP_URL . '/assets' );
		define( 'NTLFP_VIEWS', NTLFP_PATH . '/views' );
		define( 'NTLFP_LIBS', NTLFP_PATH . '/libs' );
		define( 'NTLFP_TEMPLATES_DIR', NTLFP_PATH . '/templates' );
		define( 'NTLFP_DEFAULT_THUMB', NTLFP_ASSETS .'/images/blank-bottle.png' );
	}

	
	/**
	 * Add all the assets required by the plugin
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function load_assets(){
		wp_register_style('nutralife-products', NTLFP_ASSETS.'/css/nutralife-products.css', [], date('i'));
		wp_register_script('nutralife-products', NTLFP_ASSETS.'/js/nutralife-products.js', ['jquery'], date('i'), true);
		wp_localize_script('nutralife-products', 'jsobject', ['ajaxurl' => admin_url( 'admin-ajax.php' )]);
		wp_enqueue_style('nutralife-products');
		wp_enqueue_script('nutralife-products');
	}







}

// init our class
$GLOBALS['Nutralife_Products'] = new Nutralife_Products();

/**
 * Grab the $Nutralife_Products object and return it
 */
function nutralife_products() {
	global $Nutralife_Products;
	return $Nutralife_Products;
}
