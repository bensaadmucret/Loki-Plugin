<?php
/**
 * @package  LokiPlugin
 */
/*
Plugin Name: Loki Plugin
Plugin URI: https://fr.linkedin.com/in/mohammed-bensaad-developpeur
Description: plugin stater.
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

// Require once Cmb2 métabox
if ( file_exists( dirname( __FILE__ ) . '/vendor/cmb2/cmb2/init.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/cmb2/cmb2/init.php';
}

// Require Extention
if ( file_exists( dirname( __FILE__ ) . '/extention/cmb2-admin-extension.php' ) ) {
    require_once dirname( __FILE__ ) . '/extention/cmb2-admin-extension.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_loki_plugin() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_loki_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_loki_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_loki_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::registerServices();
}




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
