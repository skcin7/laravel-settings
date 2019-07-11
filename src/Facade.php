<?php
/**
 * Laravel - Persistent Settings
 *
 * @author   Nick Morgan <nick@nicholas-morgan.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  laravel-settings
 */

namespace skcin7\LaravelSettings;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
	protected static function getFacadeAccessor()
	{
		return 'skcin7\LaravelSettings\SettingsManager';
	}
}
