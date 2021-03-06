<?php 
/**
 * @package  LokiPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	public function adminCpt()
	{
		return require_once( "$this->plugin_path/templates/cpt.php" );
	}

	public function adminTaxonomy()
	{
		return require_once( "$this->plugin_path/templates/taxonomy.php" );
	}

	public function adminWidget()
	{
		return require_once( "$this->plugin_path/templates/widget.php" );
	}

	public function adminGallery()
	{
		echo "<h1>Gallery Manager</h1>";
	}

	public function adminTestimonial()
	{
		echo "<h1>Testimonial Manager</h1>";
	}

	public function adminTemplates()
	{
		echo "<h1>Templates Manager</h1>";
	}

	public function adminAuth()
	{
		echo "<h1>Templates Manager</h1>";
	}

	public function adminMembership()
	{
		return require_once( "$this->plugin_path/templates/Membership.php" );
	}

	public function adminGestionGravity()
    {
        return require_once( "$this->plugin_path/templates/GestionGravity.php" );
    }

	public function adminChat()
	{
		return require_once( "$this->plugin_path/templates/Chat.php" );
	}

    public function adminOptionDashboard()
    {
        return require_once( "$this->plugin_path/templates/OptionDashboard.php" );
    }

    public function adminStep()
    {
        echo "<h1>Templates Step</h1>";
    }
}