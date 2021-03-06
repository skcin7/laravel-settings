<?php
/**
 * Laravel - Persistent Settings
 *
 * @author   Nick Morgan <nick@nicholas-morgan.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  laravel-settings
 */

namespace skcin7\LaravelSettings;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
	/**
	 * This provider is deferred and should be lazy loaded.
	 *
	 * @var boolean
	 */
	protected $defer = true;

	/**
	 * Register IoC bindings.
	 */
	public function register()
	{
		// Bind the manager as a singleton on the container.
		$this->app->singleton('skcin7\LaravelSettings\SettingsManager', function($app) {
			/**
			 * Construct the actual manager.
			 */
			return new SettingsManager($app);
		});

		// Provide a shortcut to the SettingStore for injecting into classes.
		$this->app->bind('skcin7\LaravelSettings\SettingStore', function($app) {
			return $app->make('skcin7\LaravelSettings\SettingsManager')->driver();
		});

		$this->app->alias('skcin7\LaravelSettings\SettingStore', 'setting');

		$this->mergeConfigFrom(__DIR__ . '/config/config.php', 'settings');
	}

	/**
	 * Boot the package.
	 */
	public function boot()
	{
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('settings.php')
        ], 'config');
	}

	/**
	 * Which IoC bindings the provider provides.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array(
			'skcin7\LaravelSettings\SettingsManager',
			'skcin7\LaravelSettings\SettingStore',
			'setting'
		);
	}
}
