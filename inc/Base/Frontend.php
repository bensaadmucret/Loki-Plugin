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
class Frontend extends BaseController
{
    public $callbacks;

    public $subpages = array();

    public function register()
    {
        if ( ! $this->activated( 'option_dashboard_manager' ) ) return;

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
                'page_title' => 'Fontend Manager',
                'menu_title' => 'Fontend',
                'capability' => 'manage_options',
                'menu_slug' => 'loki_option_dashboard',
                'callback' => array( $this->callbacks, 'adminOptionDashboard' )
            )
        );
    }
}