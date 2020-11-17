<?php
/**
 * @package  LokiPlugin
 */
namespace Inc\Base;

class OptionDashboard
{

    /**
     * OptionMembership constructor.
     */
    public function __construct() {
        add_action( 'cmb2_init', [$this,'gestion_dashboard_options_submenu_menu' ] );
    }

    /**
     *
     */
    function gestion_dashboard_options_submenu_menu() {

        $args = array(
            'id'           => 'loki_option_dashboard_main',
            'object_types' => array( 'options-page' ),
            'option_key'   => 'loki_option_dashboard',
            'parent_slug'  =>'loki_plugin',
            'tab_group'    => 'loki_dashboard_options',
            'tab_title'    => 'Gestion du Dashboard',

        );

        if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {$args['display_cb'] = 'loki_options_display_with_tabs'; }

        $main_options = new_cmb2_box( $args );

        $main_options->add_field( array(
            'name' => __( "Titre du Dashboard", 'LokiPlugin' ),
            'id' => 'id_gros_titre_dashboard',
            'type' => 'text',
            //'after_field' => "&nbsp; <em><strong>merci de rentrer  le titre le la page</strong></em>",
        ) );

        $main_options->add_field( array(
            'name' => __( 'Intoduction', 'LokiPlugin' ),
            'id' => 'id_introduction',
            'type' => 'wysiwyg',
            //'after_field' => " &nbsp; <em><strong>merci de rentrer l'introduction </strong></em>",
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