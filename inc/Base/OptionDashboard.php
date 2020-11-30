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

        $main_options->add_field(array(
            'name' => 'Shortcode',
            'description' => ' Merci de rentre vos shortcode ici',
            'id'   => 'id_shortcode',
            'type' => 'textarea_small',
            'repeatable'  => true,
            'options'     => array(
                'group_title'   => 'Ajouté un nouveau shortcode {#}',
                'add_button'    => 'Ajouté un nouveau shortcode',
                'remove_button' => 'supprimé le champ',
                'closed'        => true,  // Repeater fields closed by default - neat & compact.
                'sortable'      => true,  // Allow changing the order of repeated groups.
            ),
        ));



        $group_field_id = $main_options->add_field( array(
            'id'          => 'loki_group',
            'type'        => 'group',
            'repeatable'  => true,
            'options'     => array(
                'group_title'   => 'Ajouté une page {#}',
                'add_button'    => 'Ajouté une page',
                'remove_button' => 'supprimé la page',
                'closed'        => true,  // Repeater fields closed by default - neat & compact.
                'sortable'      => true,  // Allow changing the order of repeated groups.
            ),
        ) );




        $main_options->add_group_field( $group_field_id, array(
                'name'             => 'verrouiller la page ?',
                'id'               => 'lock_radio',
                'type'             => 'radio',
                'show_option_none' => false,
                'options'          => array(
                1    => __( 'Oui', 'cmb2' ),
                0   => __( 'Non', 'cmb2' ),

            ),
        ) );
        $main_options->add_group_field( $group_field_id, array(
            'name'             => 'validation de la page ?',
            'id'               => 'validation_radio',
            'type'             => 'radio',
            'show_option_none' => false,
            'options'          => array(
                true    => __( 'Oui', 'cmb2' ),
                false   => __( 'Non', 'cmb2' ),

            ),
        ) );

        $main_options->add_group_field( $group_field_id, array(
            'name' => 'texte de validation',
            'id'   => 'texte_de_validation',
            'type' => 'text',
            // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
        ) );
        $main_options->add_group_field( $group_field_id, array(
            'name'             => 'Etape',
            'desc'             => 'selection de l\'étape',
            'id'               => 'id_step_select',
            'type'             => 'select',
            'show_option_none' => true,
            'default'          => 'custom',
            'options'          => array(
            'Etape_1'    => __( 'Option One', 'cmb2' ),
            'Etape_2'    => __( 'Option Two', 'cmb2' ),
            'Etape_3'    => __( 'Option Three', 'cmb2' ),
            'Etape_4'    => __( 'Option Four', 'cmb2' ),
            'Etape_5'    => __( 'Option Five', 'cmb2' ),
            'Etape_6'    => __( 'Option Six', 'cmb2' ),
            'Etape_7'    => __( 'Option Seven', 'cmb2' ),
            'Etape_8'    => __( 'Option Eight', 'cmb2' ),
            'Etape_9'    => __( 'Option nine', 'cmb2' ),
            'Etape_10'   => __( 'Option Ten', 'cmb2' ),
            ),
        ) );


        // Id's for group's fields only need to be unique for the group. Prefix is not needed.
        $main_options->add_group_field( $group_field_id, array(
            'name' => 'Titre',
            'id'   => 'title',
            'type' => 'text',
            // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
        ) );
        $main_options->add_group_field( $group_field_id, array(
            'name' => __( 'Intoduction', 'LokiPlugin' ),
            'id' => 'id_contenu',
            'type' => 'wysiwyg',
            //'after_field' => " &nbsp; <em><strong>merci de rentrer l'introduction </strong></em>",
        ) );

        $main_options->add_group_field( $group_field_id, array(
            'name' => 'Shortcode',
            'description' => ' Merci de rentre vos shortcode ici',
            'id'   => 'description',
            'type' => 'textarea_small',
            'repeatable'  => true,
            'options'     => array(
                'group_title'   => 'Ajouté un nouveau shortcode {#}',
                'add_button'    => 'Ajouté un nouveau shortcode',
                'remove_button' => 'supprimé le champ',
                'closed'        => true,  // Repeater fields closed by default - neat & compact.
                'sortable'      => true,  // Allow changing the order of repeated groups.
            ),
        ) );




    }

}