<?php
/*
Plugin Name: Fontawesome Menu
Plugin URL: http://remicorson.com/sweet-custom-menu
Description: A little plugin to add attributes to WordPress menus
Version: 0.1
Author: Remi Corson
Author URI: http://remicorson.com
Contributors: corsonr
Text Domain: fa_menu
*/

class fontawesome_menu {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		// load the plugin translation files
		// add_action( 'init', array( $this, 'textdomain' ) );
		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'fa_menu_add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'fa_menu_update_custom_nav_fields'), 10, 3 );
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'fa_menu_edit_walker'), 10, 2 );

	} // end constructor
	
	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function fa_menu_add_custom_nav_fields( $menu_item ) {
	
	    $menu_item->fa_icon = get_post_meta( $menu_item->ID, '_menu_item_fa_icon', true );
	    $menu_item->fa_icon_dir = get_post_meta( $menu_item->ID, '_menu_item_fa_icon_dir', true );
	    return $menu_item;
	    
	}
	
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function fa_menu_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
	    if ( is_array( $_REQUEST['menu-item-fa_icon']) ) {
	        $fa_icon_value = $_REQUEST['menu-item-fa_icon'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_fa_icon', $fa_icon_value );
	    }

	    // Check if element is properly sent
	    if ( is_array( $_REQUEST['menu-item-fa_icon_dir']) ) {
	        $fa_icon_dir_value = $_REQUEST['menu-item-fa_icon_dir'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_fa_icon_dir', $fa_icon_dir_value );
	    }
	    
	}
	
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function fa_menu_edit_walker($walker,$menu_id) {
	
	    return 'Walker_Nav_Menu_Edit_Custom';
	    
	}

}

// instantiate plugin's class
$GLOBALS['fontawesome_menu'] = new fontawesome_menu();


include_once( 'edit_custom_walker.php' );

// Resister Font Awesome stylesheet
wp_register_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0', 'all' );
wp_enqueue_style( 'font-awesome' );

//include_once( 'custom_walker.php' );