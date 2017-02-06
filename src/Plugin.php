<?php

namespace PharIo\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use PharIo\Composer\Installer\Installer;

/**
 * Manages the plugin functionality like Installer handling
 * and command providing.
 */
class Plugin implements PluginInterface
{
    /**
     * @param Composer    $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $requirements = $composer
            ->getPluginManager()
            ->getGlobalComposer()
            ->getPackage()
            ->getRequires();

        if (array_key_exists('phar-io/composer-plugin', $requirements)) {
            return;
        }

        $installer = new Installer($composer, $io);
        $installer->install();
    }
}
