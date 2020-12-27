<?php 
/**
 * @package  LokiPlugin
 */
namespace Inc\Base;

class OptionGestionGravity
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
		'id'           => 'loki_gestion_gravity_main',
		'object_types' => array( 'options-page' ),
        'option_key'   => 'loki_gestion_gravity',
		'parent_slug'  =>'loki_plugin',
		'tab_group'    => 'loki_main_options',
		'tab_title'    => 'Gestion des fomulaires',
            'value' => array( 'loki_options' )
	    );

     if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {$args['display_cb'] = 'loki_options_display_with_tabs'; }

        $main_options = new_cmb2_box( $args );

        $main_options->add_field( array(
                'name' => __( "Formulaire d'inscription", 'LokiPlugin' ),
                'id' => 'id_inscription',
                'type' => 'text_small',
                'after_field' => "&nbsp; <em><strong>merci de rentrer  l'id du formulaire </strong></em>",
            ) );

        $main_options->add_field( array(
                'name' => __( 'Formulaire de mise à jour', 'LokiPlugin' ),
                'id' => 'id_update',
                'type' => 'text_small',
                'after_field' => " &nbsp; <em><strong>merci de rentrer  l'id du formulaire </strong></em>",
            ) );

        $main_options->add_field( array(
            'name' => __( 'Redirection après connexion', 'LokiPlugin' ),
            'id' => 'url_redirect',
            'type' => 'text_url',
            'after_field' => " &nbsp; <em><strong>merci de rentrer  l'url </strong></em>",
        ) );

        $gravity_group_id = $main_options->add_field( array(
                'id'          => 'loki_group',
                'type'        => 'group',
                'repeatable'  => true,
                'options'     => array(
                    'group_title'   => 'Ajouté un champ au formulaire {#}',
                    'add_button'    => 'Ajouté un champ',
                    'remove_button' => 'supprimé le champ',
                    'closed'        => true,  // Repeater fields closed by default - neat & compact.
                    'sortable'      => true,  // Allow changing the order of repeated groups.
                ),
            ) );

        $main_options->add_group_field( $gravity_group_id, array(
            'name' => 'Titre',
            'desc' => 'Entre le titre du formulaire.',
            'id'   => 'title',
            'type' => 'text',
        ) );
        $main_options->add_group_field( $gravity_group_id, array(
            'name' => 'Label',
            'desc' => 'Enter the url of the post.',
            'id'   => 'label',
            'type' => 'text',
        ) );

    }

}