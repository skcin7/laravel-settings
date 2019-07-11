<?php
/**
 * Laravel - Persistent Settings
 * 
 * @author   Nick Morgan <nick@nicholas-morgan.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  laravel-settings
 */

namespace skcin7\LaravelSettings;

use \Illuminate\Support\Facades\Config;
use Illuminate\Filesystem\Filesystem;

class SettingStore
{
	/**
	 * The settings data.
	 *
	 * @var array
	 */
	protected $data = [];

	/**
	 * Whether the store has changed since it was last loaded.
	 *
	 * @var boolean
	 */
	protected $unsaved = false;

	/**
	 * Whether the settings data are loaded.
	 *
	 * @var boolean
	 */
	protected $loaded = false;

    /**
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param string $path
     */
    public function __construct(Filesystem $files, $path = null)
    {
        $this->files = $files;
        $this->setPath($path ?: storage_path() . '/app/settings.json');
    }

    /**
     * Set the path for the JSON file.
     *
     * @param string $path
     */
    public function setPath($path)
    {
        // If the file does not already exist, we will attempt to create it.
        if(! $this->files->exists($path)) {
            $result = $this->files->put($path, '{}');
            if ($result === false) {
                throw new \InvalidArgumentException("Could not write to $path.");
            }
        }

        if(! $this->files->isWritable($path)) {
            throw new \InvalidArgumentException("$path is not writable.");
        }

        $this->path = $path;
    }

	/**
	 * Get a specific key from the settings data.
	 *
	 * @param  string|array $key
	 * @param  mixed        $default Optional default value.
	 *
	 * @return mixed
	 */
	public function get($key, $default = null)
	{
		if($default === null && ! is_array($key)) {
			$default = Config::get('settings.defaults.' . $key);
		}
        
		$this->load();

		return ArrayUtil::get($this->data, $key, $default);
	}

	/**
	 * Determine if a key exists in the settings data.
	 *
	 * @param  string  $key
	 *
	 * @return boolean
	 */
	public function has($key)
	{
		$this->load();

		return ArrayUtil::has($this->data, $key);
	}

	/**
	 * Set a specific key to a value in the settings data.
	 *
	 * @param string|array $key   Key string or associative array of key => value
	 * @param mixed        $value Optional only if the first argument is an array
	 */
	public function set($key, $value = null)
	{
		$this->load();
		$this->unsaved = true;
		
		if (is_array($key)) {
			foreach ($key as $k => $v) {
				ArrayUtil::set($this->data, $k, $v);
			}
		} else {
			ArrayUtil::set($this->data, $key, $value);
		}
	}

	/**
	 * Unset a key in the settings data.
	 *
	 * @param  string $key
	 */
	public function forget($key)
	{
		$this->unsaved = true;

		if ($this->has($key)) {
			ArrayUtil::forget($this->data, $key);
		}
	}

	/**
	 * Unset all keys in the settings data.
	 *
	 * @return void
	 */
	public function forgetAll()
	{
		$this->unsaved = true;
		$this->data = array();
	}

	/**
	 * Get all settings data.
	 *
	 * @return array
	 */
	public function all()
	{
		$this->load();

		return $this->data;
	}

	/**
	 * Save any changes done to the settings data.
	 *
	 * @return void
	 */
	public function save()
	{
		if (!$this->unsaved) {
			// either nothing has been changed, or data has not been loaded, so
			// do nothing by returning early
			return;
		}

		$this->write($this->data);
		$this->unsaved = false;
	}

	/**
	 * Make sure data is loaded.
	 *
	 * @param $force Force a reload of data. Default false.
	 */
	public function load($force = false)
	{
		if(! $this->loaded || $force) {
			$this->data = $this->read();
			$this->loaded = true;
		}
	}

	/**
	 * Read the data from the store.
	 *
	 * @return array
	 */
    protected function read()
    {
        $contents = $this->files->get($this->path);

        $data = json_decode($contents, true);

        if($data === null) {
            throw new \RuntimeException("Invalid JSON in {$this->path}");
        }

        return $data;
    }

	/**
	 * Write the data into the store.
	 *
	 * @param  array  $data
	 * @return void
	 */
    protected function write(array $data)
    {
        if($data) {
            $contents = json_encode($data, JSON_PRETTY_PRINT);
        }
        else {
            $contents = '{}';
        }

        $this->files->put($this->path, $contents);
    }
}
