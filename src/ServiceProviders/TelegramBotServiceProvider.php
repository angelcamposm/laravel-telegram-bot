<?php

namespace Acamposm\TelegramBot\ServiceProviders;

use Acamposm\TelegramBot\Bot;
use Acamposm\TelegramBot\Console\InstallTelegramBotCommand;
use Acamposm\TelegramBot\Telegram;
use Illuminate\Support\ServiceProvider;

class TelegramBotServiceProvider extends ServiceProvider
{
    /**
     * Boot the application's service providers.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfig();
            $this->registerCommands();
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('bot', function($app) {
            return new Bot();
        });

        $this->app->singleton('telegram', function($app) {
            return new Telegram();
        });

        $this->mergeConfig();
    }

    /**
     * Returns the config file path.
     *
     * @return string
     */
    private function getConfigPath(): string
    {
        return __DIR__.'/../../config/config.php';
    }

    /**
     * Automatically apply the package configuration.
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom($this->getConfigPath(), 'telegram');
    }

    /**
     * Publish Config File.
     */
    private function publishConfig()
    {
        $path = $this->getConfigPath();

        $this->publishes([
            $path => config_path('telegram.php'),
        ], 'config');
    }

    /**
     * Registering package commands.
     */
    private function registerCommands()
    {
        $this->commands([
            InstallTelegramBotCommand::class,
        ]);
    }
}