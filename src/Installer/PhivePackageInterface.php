<?php
namespace PharIo\Composer\Installer;

use Composer\Package\PackageInterface;

interface PhivePackageInterface extends PackageInterface {

    /**
     * @return string
     */
    public function getInstallationPath();
}
