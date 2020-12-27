<?php
/**
 * @package  LokiPlugin
 */
namespace Inc\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();

		$default = array();

		if ( ! get_option( 'loki_plugin' ) ) {
			update_option( 'loki_plugin', $default );
		}

		if ( ! get_option( 'loki_plugin_cpt' ) ) {
			update_option( 'loki_plugin_cpt', $default );
		}

		if ( ! get_option( 'loki_plugin_tax' ) ) {
			update_option( 'loki_plugin_tax', $default );
		}
	}
}