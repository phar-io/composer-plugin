<?php

namespace PharIo\Composer;

use Composer\Composer;
use Composer\Factory;
use Composer\IO\IOInterface;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\Capability\CommandProvider;
use PharIo\Composer\Console\InfoCommand;
use PharIo\Composer\Console\PhiveBinary;
use PharIo\Composer\Console\RunCommand;
use PharIo\Composer\Installer\Configuration;
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
        if (true === (new PhiveBinary())->exists()) {
            return;
        }

        $options = [];
        $extras = $composer->getPackage()->getExtra();

        if (isset($extras['phar-io'])) {
            $options = $extras['phar-io'];
        }

        $installer = new Installer($composer, $io);
        $installer->install(new Configuration($options));
    }

    /**
     * @return array
     */
    public function getCapabilities() {
        return [
            CommandProvider::class => self::class,
        ];
    }

    /**
     * @return array
     */
    public function getCommands() {
        return [
            new RunCommand,
            new InfoCommand,
        ];
    }
}
