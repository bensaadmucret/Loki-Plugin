<?php 
/**
 * @package  LokiPlugin
 */
namespace Inc\Base;

class OptionMembership
{
	
	public function __construct() {
        add_action( 'cmb2_admin_init', [$this,'membership_register_options_submenu_menu'] );
    }
    
    function membership_register_options_submenu_menu() {

        $cmb_options = new_cmb2_box( array(
            'id'           => 'alecaddd_membership',
            'object_types' => array( 'options-page' ),
            'option_key'      => 'alecaddd_membership',
            'parent_slug'     => 'alecaddd_plugin', 
           
        ) );
        $cmb_options->add_field( array(
            'name'    => esc_html__( 'Site Background Color', 'cmb2' ),
            'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
            'id'      => 'bg_color',
            'type'    => 'colorpicker',
            'default' => '#ffffff',
        ) );
    
    }

}