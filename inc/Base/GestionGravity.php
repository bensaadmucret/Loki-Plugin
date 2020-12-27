<?php

/**
 * @package  LokiPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
 *
 */
class GestionGravity extends BaseController
{
    public $callbacks;

    public $subpages = array();

    public function register()
    {
        if ( ! $this->activated( 'gestion_gravity_manager' ) ) return;

        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->setSubpages();

        $this->settings->addSubPages( $this->subpages )->register();
    }

    public function setSubpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'loki_plugin',
                'page_title' => 'Gestion des formulaire',
                'menu_title' => 'Gravity Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'loki_gestion_gravity',
                'callback' => array( $this->callbacks, 'adminGestionGravity' )
            )
        );
    }
}