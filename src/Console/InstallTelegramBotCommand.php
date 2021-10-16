<?php

namespace Acamposm\TelegramBot\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallTelegramBotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install de Telegram Bot package.';

    /**
     * The console command help text.
     *
     * @var string
     */
    protected $help = 'Installs the Telegram Bot package.';

    /**
     * Indicates whether the command should be shown in the Artisan command list.
     *
     * @var bool
     */
    protected $hidden = false;

    public function handle()
    {
        $this->info('Installing Telegram Bot package...');

        $this->info('Publishing configuration...');

        if (! $this->configExists()) {
            $this->performActionsOnNonExistingFile();
        } else {
            $this->performActionsOnExistingFile();
        }

        $this->info('Installed Telegram Bot package.');
    }

    /**
     * Check if config file exists.
     *
     * @return bool
     */
    private function configExists(): bool
    {
        return File::exists(config_path('telegram.php'));
    }

    /**
     * Publish package configuration.
     *
     * @param bool $forcePublish
     */
    private function publishConfiguration(bool $forcePublish = false)
    {
        $params = [
            '--provider' => "Acamposm\TelegramBot\TelegramBotServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = '';
        }

        $this->call('vendor:publish', $params);
    }

    /**
     * Displays an overwrite confirmation in the console.
     *
     * @return bool
     */
    private function shouldOverwriteConfig(): bool
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function performActionsOnExistingFile()
    {
        if ($this->shouldOverwriteConfig()) {

            $this->info('Overwriting configuration file...');

            $this->publishConfiguration(true);

        } else {

            $this->info('Existing configuration was not overwritten.');
        }
    }

    private function performActionsOnNonExistingFile()
    {
        $this->publishConfiguration();
        $this->info('Published configuration');
    }
}