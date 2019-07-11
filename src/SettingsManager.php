<?php
/**
 * Laravel - Persistent Settings
 *
 * @author   Nick Morgan <nick@nicholas-morgan.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  laravel-settings
 */

namespace skcin7\LaravelSettings;

use Illuminate\Support\Manager;
use Illuminate\Foundation\Application;

class SettingsManager extends Manager
{
	public function getDefaultDriver()
	{
		return $this->getConfig('skcin7/laravel-settings::store');
	}

	public function createJsonDriver()
	{
		$path = $this->getConfig('skcin7/laravel-settings::path');

		return new SettingStore($this->app['files'], $path);
	}

    protected function getConfig($key)
    {
        $key = str_replace('skcin7/laravel-settings::', 'settings.', $key);

        return $this->app['config']->get($key);
    }


}
