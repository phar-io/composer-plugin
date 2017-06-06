<?php
namespace PharIo\Composer\Installer;

use Composer\Package\Package;

class PhivePackage extends Package implements PhivePackageInterface {

    public function __construct() {
        parent::__construct('phive', 'latest', 'latest');
    }

    public function getDistUrl() {
        return 'https://phar.io/releases/phive.phar';
    }

    public function getDistUrls() {
        return [$this->getDistUrl()];
    }

    public function getInstallationSource() {
        return 'dist';
    }

    /**
     * @return string
     */
    public function getInstallationPath() {
        return __DIR__ . '/../../bin/' . basename($this->getDistUrl());
    }
}
