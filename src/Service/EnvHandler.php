<?php
namespace App\Service;

/***
   * This classes Handles Env Operations
   */
class EnvHandler
{
    protected array $env;

    /***
   * This is function initializes the env handler
   */
    public function __construct()
    {
        // Load only once per request if not already loaded
        if (!isset($_ENV['_loaded'])) {
            $this->loadEnv();
            $_ENV['_loaded'] = true;
        }

        $this->env = $_ENV;
    }

    /***
   * This is function load all the ENV from the file
   */
    protected function loadEnv(): void
    {
        $envPath = BASE_PATH . '/.env';

        if (!file_exists($envPath)) {
            throw new \Exception(".env file not found at $envPath");
        }

        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) continue;

            list($name, $value) = array_map('trim', explode('=', $line, 2));
            $_ENV[$name] = $value;
        }
    }
    /***
   * This is function returns all the env Values
   * @params string key
   * @return mixed envValues
   */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->env[$key] ?? $default;
    }
}
