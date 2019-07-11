<?php

return [
	/*
	|--------------------------------------------------------------------------
	| Default Settings Store
	|--------------------------------------------------------------------------
	|
	| This option controls the default settings store that gets used while
	| using this settings library.
	|
	| Supported: "json", "database"
	|
	*/
	'store' => 'json',

    /*
    |--------------------------------------------------------------------------
    | JSON Store
    |--------------------------------------------------------------------------
    |
    | If the store is set to "json", settings are stored in the defined
    | file path in JSON format. Use full path to file.
    |
    */
    'path' => storage_path().'/app/settings.json',

    /*
	|--------------------------------------------------------------------------
	| Store Using Pretty Print
	|--------------------------------------------------------------------------
	|
	| If this is true, the saved JSON file will always be saved with easily
    | human-readable formatting.  Otherwise, all saved JSON will be
    | condensed to a single line.
	|
	*/
    'pretty_print' => true,
    
    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    |
    | Define all default settings that will be used before any settings are set,
    | this avoids all settings being set to false to begin with and avoids
    | hardcoding the same defaults in all 'Settings::get()' calls
    |
    */
//    'defaults' => [
//        'foo' => 'bar',
//    ]
];
