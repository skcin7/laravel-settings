<?php

/*
|--------------------------------------------------------------------------
| Custom helper functions for use with the package.
|--------------------------------------------------------------------------
|
| Add custom helper functions that could be used throughout the app here
|
*/

if(! function_exists('setting')) {
    /**
     * Create a settings helper for accessing the package.
     *
     * @param null $key
     * @param null $default
     * @return \Illuminate\Foundation\Application|mixed
     */
    function setting($key = null, $default = null)
    {
        $setting = app('setting');

        if(is_array($key)) {
            $setting->set($key);
        }
        elseif(! is_null($key)) {
            return $setting->get($key, $default);
        }

        return $setting;
    }
}