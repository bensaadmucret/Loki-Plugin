<?php
/**
 * @package  LokiPlugin
 */
namespace Inc;

final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function getServices()
	{
		return [
			Pages\Dashboard::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class,
			Base\CustomPostTypeController::class,
			Base\CustomTaxonomyController::class,
			Base\WidgetController::class,
			Base\GalleryController::class,
			Base\TestimonialController::class,
			Base\TemplateController::class,
			//Base\AuthController::class,
            Base\OptionGestionGravity::class,
			Base\MembershipController::class,
			Base\ChatController::class,
            Base\UserContactChamps::class,
            Base\GestionGravity::class,
            Base\loginRedirectUrl::class,
            Base\AddKeysGravity::class,
            Base\RegisterShortcode::class,
            Base\DashboardShorcode::class,
            Base\Frontend::class,
            Base\OptionDashboard::class,
		];
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists
	 * @return
	 */
	public static function registerServices()
	{
		foreach (self::getServices() as $class) {
			$service = self::instantiate($class);
			if (method_exists($service, 'register')) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate($class)
	{
		$service = new $class();

		return $service;
	}
}
