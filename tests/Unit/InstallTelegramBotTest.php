<?php

namespace Acamposm\TelegramBot\Tests\Unit;

use Acamposm\TelegramBot\Tests\OrchestraTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class InstallTelegramBotTest extends OrchestraTestCase
{
    const COMMAND = 'telegram:install';
    const FILE = 'telegram.php';

    public function test_can_get_a_config_file_path()
    {
        $file_path = config_path(self::FILE);

        $this->assertStringContainsString(self::FILE, $file_path);

        return $file_path;
    }

    /**
     * @depends test_can_get_a_config_file_path
     */
    public function test_can_install_package(string $file_path)
    {
        // make sure we're starting from a clean state
        if (File::exists($file_path)) {
            unlink($file_path);
        }

        $this->assertFalse(File::exists($file_path));

        Artisan::call(self::COMMAND);

        $this->assertTrue(File::exists($file_path));
    }

    /**
     * @depends test_can_get_a_config_file_path
     */
    public function test_when_a_config_file_is_present_users_can_choose_to_not_overwrite_it(string $file_path)
    {
        // Given we already have an existing config file
        File::put($file_path, 'test contents');

        $this->assertTrue(File::exists($file_path));

        // When we run the install command
        $command = $this->artisan(self::COMMAND);

        // We expect a warning that our configuration file exists
        $command->expectsQuestion(
            'Config file already exists. Do you want to overwrite it?',
            // When answered with "no"
            'no'
        );

        // We should see a message that our file was not overwritten
        $command->expectsOutput('Existing configuration was not overwritten');

        // Assert that the original contents of the config file remain
        $this->assertEquals(file_get_contents($file_path), 'test contents');

        // Clean up
        unlink($file_path);
    }

    /**
     * @depends test_can_get_a_config_file_path
     */
    public function when_a_config_file_is_present_users_can_choose_to_do_overwrite_it(string $file_path)
    {
        // Given we already have an existing config file
        File::put($file_path, 'test contents');

        $this->assertTrue(File::exists($file_path));

        // When we run the install command
        $command = $this->artisan(self::COMMAND);

        // We expect a warning that our configuration file exists
        $command->expectsQuestion(
            'Config file already exists. Do you want to overwrite it?',
            // When answered with "yes"
            'yes'
        );

        $command->expectsOutput('Overwriting configuration file...');

        // Assert that the original contents are overwritten
        $this->assertEquals(
            file_get_contents($file_path),
            file_get_contents(__DIR__.'/../config/config.php')
        );

        // Clean up
        unlink($file_path);
    }
}