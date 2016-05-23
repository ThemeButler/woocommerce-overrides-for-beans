<?php
/*
Plugin Name: WooCommerce Overrides for Beans
Plugin URI: http://www.themebutler.com
Description: Utilize the power of Beans in your WooCommerce projects. Can be used with the Beans parent theme or child-themes created for Beans.
Version: 1.0.0-Alpha-2
Author: ThemeButler
Author URI: http://www.themebutler.com
License: GNU GPL v2
*/

// Stop here if Beans is not available.
if ( !file_exists( get_template_directory() . '/lib/api/init.php' ) )
	return;

// Include Beans
require_once( get_template_directory() . '/lib/api/init.php' );

// Register needed components
beans_load_api_components( array(
	'actions',
	'html',
	'image',
	'compiler',
	'uikit',
	'template',
	'layout',
	'widget'
) );


// Define constants
define( 'WCB_PLUGIN_PATH' untrailingslashit( plugin_dir_path( __FILE__ ) ) );


// Register the plugins WooCommerce template overrides
add_filter( 'woocommerce_locate_template', 'wcb_woocommerce_locate_template', 10, 3 );

function wcb_woocommerce_locate_template( $template, $template_name, $template_path ) {

  global $woocommerce;

  $_template = $template;

  if ( ! $template_path ) $template_path = $woocommerce->template_url;
  $plugin_path  = WCB_PLUGIN_PATH . '/woocommerce/';

  // Look within passed path within the theme - this is priority
  $template = locate_template(
    array(
      $template_path . $template_name,
      $template_name
    )
  );

  // Modification: Get the template from this plugin, if it exists
  if ( ! $template && file_exists( $plugin_path . $template_name ) )
    $template = $plugin_path . $template_name;

  // Use default template
  if ( ! $template )
    $template = $_template;

  // Return what we found
  return $template;

}


// Add WooCommerce theme support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


// Use the Beans layout engine
add_filter( 'beans_layout', 'wcb_woocommerce_layout' );

function wcb_woocommerce_layout( $layout ) {

    // Get the layout post meta from woo shop page.
    if ( is_shop() ) {
        return beans_get_post_meta( 'beans_layout', beans_get_default_layout(), wc_get_page_id( 'shop' ) );
    }

    return $layout;

}
