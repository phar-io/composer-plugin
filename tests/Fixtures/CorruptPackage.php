<?php
namespace PharIo\Composer\Tests\Fixtures;

use Composer\Package\Package;
use PharIo\Composer\Installer\PhivePackageInterface;

final class CorruptPackage extends Package implements PhivePackageInterface {

    public function __construct() {
        parent::__construct('corrupt', 'latest', 'latest');
    }

    public function getInstallationPath() {
        return __DIR__ . '/corrupt.phar';
    }
}
