<?php

namespace phlounder;

/**
 * Confinguration handler
 */
class config
{
    /**
     * List of configuration items
     *
     * @var array<string|int>
     */
    private static array $_config = [];

    /**
     * The path of the desired configuration file
     *
     * @var string|null
     */
    private static string|null $_config_path;

    public function __construct(string|null $path = null)
    {
        self::$_config_path = $path;
    }

    /**
     * Loading of the specified config file
     *
     * @return array<string|int> Returns the desired config or an empty array
     */
    private static function config_file_load(): array
    {
        if (null === self::$_config_path) {
            return [];
        }

        if (true === file_exists(self::$_config_path)) {
            return require_once(self::$_config_path);
        }

        return [];
    }

    /**
     * Does the desired key exist in the configuration
     *
     * @param string $key The key to search
     *
     * @return bool If the key exists **true**, otherwise **false**
     */
    public static function exists(string $key): bool
    {
        if (false === empty(self::$_config[$key])) {
            return true;
        }

        return false;
    }

    /**
     * Retrieval of a configuration value.
     *
     * @param string $key The configuration key to retrieve.
     * @param string|int|null $default The default value returned if not found
     *
     * @return string|int|null The located kkeys value, otherwise the default
     */
    public static function get(
        string $key,
        string|int|null $default = null
    ): string|int|null {
        if (0 === count(self::$_config)) {
            self::$_config = self::config_file_load();
        }

        if (true === self::exists($key)) {
            return self::$_config[$key];
        }

        return $default;
    }

    /**
     * Create a value for the desired key
     *
     * The key/value pair will not be set if the key already exists
     *
     * @param string $key The key for the value to be set
     * @param string|int $value The value that is to be set
     *
     * @return bool **true** if successful, **false** otherwise
     */
    public static function set(string $key, string|int $value): bool
    {
        $existing = self::exists($key);

        if (true === $existing) {
            return false;
        }

        self::$_config[$key] = $value;

        if (true === self::exists($key) && $value === self::get($key)) {
            return true;
        }

        return false;
    }

    /**
     * Update the value of a key/pair
     *
     * If they key does not exist then it will be created.
     *
     * @param string $key The key that will have the value mutated
     * @param string|int $value The value to be assigned to the key
     *
     * @return bool **true** if the key is updated/created, **false** otherwise
     */
    public static function update(string $key, string|int $value): bool
    {
        if (false === self::exists($key)) {
            return self::set($key, $value);
        }

        self::$_config[$key] = $value;

        if (true === self::exists($key) && $value === self::get($key)) {
            return true;
        }

        return false;
    }
}
