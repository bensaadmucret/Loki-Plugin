<?php 
/**
 * @package  LokiPlugin
 */
namespace Inc\Base;

class BaseController
{
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public $managers = array();

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/loki-plugin.php';

		$this->managers = [
			'cpt_manager' => 'Activate CPT Manager',
			'taxonomy_manager' => 'Activate Taxonomy Manager',
			'media_widget' => 'Activate Media Widget',
			'gallery_manager' => 'Activate Gallery Manager',
			'testimonial_manager' => 'Activate Testimonial Manager',
			'templates_manager' => 'Activate Custom Templates',
			'login_manager' => 'Activate Ajax Login/Signup',
			'gestion_gravity_manager' => 'Activate Gestions des Formulaires',
			'membership_manager' => 'Activate Membership Manager',
			'chat_manager' => 'Activate Chat Manager',
            'option_dashboard_manager' => 'Activate Gestion font-end',
            'step_manager' => 'Activate Gestion des pages étapes',

        ];
	}

	public function activated( string $key )
	{
		$option = get_option( 'loki_plugin' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}
}