<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabaseConnectionEnvironment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'envDBConnection:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command sets the environment database credentials';

    /**
     * @param $key
     * @param $value
     */
    protected function setEnvValue($key, $value)
    {
        $path = app()->environmentFilePath();
        $env = file_get_contents($path);
        $old_value = env($key);

        if (!str_contains($env, $key . '=')) {
            $env .= sprintf("%s=%s\n", $key, $value);
        } else if ($old_value) {
            $env = str_replace(sprintf('%s=%s', $key, $old_value), sprintf('%s=%s', $key, $value), $env);
        } else {
            $env = str_replace(sprintf('%s=', $key), sprintf('%s=%s', $key, $value), $env);
        }

        file_put_contents($path, $env);
    }

    public function handle(): void
    {
        $username = $this->ask('What\'s DB_USERNAME?');
        $password = $this->ask('What\'s DB_PASSWORD?');

        if (!empty($username) && !empty($password)) {
            $this->setEnvValue('DB_USERNAME', $username);
            $this->setEnvValue('DB_PASSWORD', $password);
        }

        $this->info("Env file updated!");
    }
}
