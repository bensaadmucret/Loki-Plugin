<?php 
/**
 * @package  LokiPlugin
 */
namespace Inc\Base;

use Inc\Base\BaseController;

/**
* 
*/
class Enqueue extends BaseController
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
        add_action( 'wp_enqueue_scripts', [$this,'add_external_scripts'] );
        add_action( 'wp_enqueue_scripts', [$this,'boostrap_enqueue'] );
	}
	
	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_media();
        wp_enqueue_style('pure', "https://unpkg.com/purecss@2.0.3/build/pure-min.css");
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'assets/mystyle.css' );
		wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'assets/myscript.js' );
	}

    function add_external_scripts() {
        wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
		wp_enqueue_style( 'tailwindcsse', 'https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css');
		
    }

    function boostrap_enqueue() {
        wp_register_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), NULL, true );
        wp_register_style( 'bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', false, NULL, 'all' );

        wp_enqueue_script( 'bootstrap-js' );
       // wp_enqueue_style( 'bootstrap-css' );
    }


}