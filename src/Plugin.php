<?php
namespace PharIo\Composer;

use Composer\Composer;
use Composer\Factory;
use Composer\IO\IOInterface;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\Capability\CommandProvider;
use PharIo\Composer\Console\InfoCommand;
use PharIo\Composer\Console\RunCommand;
use PharIo\Composer\Installer\Installer;

/**
 * Manages the plugin functionality like Installer handling
 * and command providing.
 */
class Plugin implements PluginInterface, Capable, CommandProvider {

    /**
     * @param Composer    $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io) {
        if (file_exists(__DIR__ . '/../bin/phive.phar')) {
            return;
        }

        $installer = new Installer($composer, $io);
        $installer->install();
    }

    public function getCapabilities() {
        return [
            CommandProvider::class => self::class,
        ];
    }

    public function getCommands() {
        return [
            new RunCommand,
            new InfoCommand,
        ];
    }
}
