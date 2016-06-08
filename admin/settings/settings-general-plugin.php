<?php
/**
 * General settings for plugin bootstrap
 *
 * This is the file with general settings for ItalyStrap plugin
 *
 * @since 2.0.0
 *
 * @package Italystrap
 */

namespace ItalyStrap\Admin;

if ( ! defined( 'ABSPATH' ) or ! ABSPATH ) {
	die();
}

return array(
	'options_name'			=> 'italystrap_settings',
	'options_group'			=> 'italystrap_options_group',
	'admin_view_path'		=> ITALYSTRAP_PLUGIN_PATH . 'admin/admin-template/',
	'plugin_action_links'	=> array(
		'<a href="admin.php?page=italystrap-documentation">' . __( 'Documentation','italystrap' ) . '</a>',
		'<a href="http://www.italystrap.it" target="_blank">ItalyStrap</a>',
		),
	'menu_page'				=> array(
		'page_title'		=> __( 'ItalyStrap Dashboard', 'italystrap' ),
		'menu_title'		=> 'ItalyStrap',
		// 'capability'		=> $this->capability,
		'menu_slug'			=> 'italystrap-dashboard',
		// 'function'		=> array( $this, 'get_admin_view' ),
		'icon_url'			=> 'dashicons-performance',
		'position'			=> null,
	),
	'submenu_pages'	=> array(
		array(
			'parent_slug'	=> 'italystrap-dashboard',//'edit.php?post_type=stores'
			'page_title'	=> __( 'Documentation', 'italystrap' ),
			'menu_title'	=> __( 'Documentation', 'italystrap' ),
			// 'capability'	=> $this->capability,
			'menu_slug'		=> 'italystrap-documentation',
			// 'function_cb'	=> array( $this, 'get_admin_view' ),
		),
		array(
			'parent_slug'	=> 'italystrap-dashboard',
			'page_title'	=> __( 'Options', 'italystrap' ),
			'menu_title'	=> __( 'Options', 'italystrap' ),
			// 'capability'	=> $this->capability,
			'menu_slug'		=> 'italystrap-options',
			// 'function_cb'	=> array( $this, 'get_admin_view' ),
		),
		array(
			'parent_slug'	=> 'italystrap-dashboard',
			'page_title'	=> __( 'Import/Export', 'italystrap' ),
			'menu_title'	=> __( 'Import/Export', 'italystrap' ),
			// 'capability'	=> $this->capability,
			'menu_slug'		=> 'italystrap-import-export',
			// 'function_cb'	=> array( $this, 'get_admin_view' ),
		),
	),
);