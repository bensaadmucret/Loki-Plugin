<?php 
/**
 * @package  LokiPlugin
 */
namespace Inc\Base;

class OptionMembership
{

    /**
     * OptionMembership constructor.
     */
    public function __construct() {
        add_action( 'cmb2_init', [$this,'register_gravity_options_submenu_menu' ] );
    }

    /**
     *
     */
    function register_gravity_options_submenu_menu() {

        $args = array(
		'id'           => 'loki_membership',
		'object_types' => array( 'options-page' ),
		'option_key'   => 'loki_membership',
		'parent_slug'  =>'loki_plugin',
		'tab_group'    => 'loki_main_options',
		'tab_title'    => 'Gestion des fomulaires',
	    );

     if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {$args['display_cb'] = 'loki_options_display_with_tabs'; }

        $main_options = new_cmb2_box( $args );
        $main_options->add_field( array(
                'name' => __( "Formulaire d'inscription", 'LokiPlugin' ),
                'id' => 'id_inscription',
                'type' => 'text_small',
                'after_field' => "merci de rentrer  l'id du formulaire",
            ) );

        $main_options->add_field( array(
                'name' => __( 'Formulaire de mise à jour', 'LokiPlugin' ),
                'id' => 'id_update',
                'type' => 'text_small',
                'after_field' => "merci de rentrer  l'id du formulaire",
            ) );
    
    }

}