<?php
/**
 * @package  LokiPlugin
 */
/*
Plugin Name: Loki Plugin
Plugin URI: https://fr.linkedin.com/in/mohammed-bensaad-developpeur
Description: This is my first attempt on writing a custom Plugin for this amazing tutorial series.
Version: 1.0.0
Author: Mohammed "Ben" Bensaad
Author URI: https://fr.linkedin.com/in/mohammed-bensaad-developpeur
License: GPLv2 or later
Text Domain: loki-plugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_alecaddd_plugin() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_alecaddd_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_alecaddd_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_alecaddd_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::registerServices();
}

function yourprefix_register_main_options_metabox() {

	/**
	 * Registers main options page menu item and form.
	 */
	$args = array(
		'id'           => 'alecaddd_chat',
		//'title'        => 'Main Options',
		'object_types' => array( 'options-page' ),
		'option_key'   => 'alecaddd_chat',
		'parent_slug'     => 'alecaddd_plugin',
		'tab_group'    => 'yourprefix_main_options',
		'tab_title'    => 'Main',
	);

	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		$args['display_cb'] = 'yourprefix_options_display_with_tabs';
	}

	$main_options = new_cmb2_box( $args );

	/**
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
	 */
	$main_options->add_field( array(
		'name'    => 'Site Background Color',
		'desc'    => 'field description (optional)',
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );

	/**
	 * Registers secondary options page, and set main item as parent.
	 */
	$args = array(
		'id'           => 'yourprefix_secondary_options_page',
		//'menu_title'   => 'Secondary Options', // Use menu title, & not title to hide main h2.
		'object_types' => array( 'options-page' ),
		'option_key'   => 'yourprefix_secondary_options',
		'parent_slug'  => 'alecaddd_plugin',
		'tab_group'    => 'yourprefix_main_options',
		'tab_title'    => 'Secondary',
	);

	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		$args['display_cb'] = 'yourprefix_options_display_with_tabs';
	}

	$secondary_options = new_cmb2_box( $args );

	$secondary_options->add_field( array(
		'name'    => 'Test Radio',
		'desc'    => 'field description (optional)',
		'id'      => 'radio',
		'type'    => 'radio',
		'options' => array(
			'option1' => 'Option One',
			'option2' => 'Option Two',
			'option3' => 'Option Three',
		),
	) );

	/**
	 * Registers tertiary options page, and set main item as parent.
	 */
	$args = array(
		'id'           => 'yourprefix_tertiary_options_page',
		//'menu_title'   => 'Tertiary Options', // Use menu title, & not title to hide main h2.
		'object_types' => array( 'options-page' ),
		'option_key'   => 'yourprefix_tertiary_options',
		'parent_slug'  => 'alecaddd_plugin',
		'tab_group'    => 'yourprefix_main_options',
		'tab_title'    => 'Tertiary',
	);

	// 'tab_group' property is supported in > 2.4.0.
	if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
		$args['display_cb'] = 'yourprefix_options_display_with_tabs';
	}

	$tertiary_options = new_cmb2_box( $args );

	$tertiary_options->add_field( array(
		'name' => 'Test Text Area for Code',
		'desc' => 'field description (optional)',
		'id'   => 'textarea_code',
		'type' => 'textarea_code',
	) );

}
add_action( 'cmb2_admin_init', 'yourprefix_register_main_options_metabox' );

/**
 * A CMB2 options-page display callback override which adds tab navigation among
 * CMB2 options pages which share this same display callback.
 *
 * @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
 */
function yourprefix_options_display_with_tabs( $cmb_options ) {
	$tabs = yourprefix_options_page_tabs( $cmb_options );
	?>
	<div class="wrap cmb2-options-page option-<?php echo $cmb_options->option_key; ?>">
		<?php if ( get_admin_page_title() ) : ?>
			<h2><?php echo wp_kses_post( get_admin_page_title() ); ?></h2>
		<?php endif; ?>
		<h2 class="nav-tab-wrapper">
			<?php foreach ( $tabs as $option_key => $tab_title ) : ?>
				<a class="nav-tab<?php if ( isset( $_GET['page'] ) && $option_key === $_GET['page'] ) : ?> nav-tab-active<?php endif; ?>" href="<?php menu_page_url( $option_key ); ?>"><?php echo wp_kses_post( $tab_title ); ?></a>
			<?php endforeach; ?>
		</h2>
		<form class="cmb-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" id="<?php echo $cmb_options->cmb->cmb_id; ?>" enctype="multipart/form-data" encoding="multipart/form-data">
			<input type="hidden" name="action" value="<?php echo esc_attr( $cmb_options->option_key ); ?>">
			<?php $cmb_options->options_page_metabox(); ?>
			<?php submit_button( esc_attr( $cmb_options->cmb->prop( 'save_button' ) ), 'primary', 'submit-cmb' ); ?>
		</form>
	</div>
	<?php
}

/**
 * Gets navigation tabs array for CMB2 options pages which share the given
 * display_cb param.
 *
 * @param CMB2_Options_Hookup $cmb_options The CMB2_Options_Hookup object.
 *
 * @return array Array of tab information.
 */
function yourprefix_options_page_tabs( $cmb_options ) {
	$tab_group = $cmb_options->cmb->prop( 'tab_group' );
	$tabs      = array();

	foreach ( CMB2_Boxes::get_all() as $cmb_id => $cmb ) {
		if ( $tab_group === $cmb->prop( 'tab_group' ) ) {
			$tabs[ $cmb->options_page_keys()[0] ] = $cmb->prop( 'tab_title' )
				? $cmb->prop( 'tab_title' )
				: $cmb->prop( 'title' );
		}
	}

	return $tabs;
}
