<?php
namespace PharIo\Composer\Installer;

use Composer\Package\Package;

class PhiveSignaturePackage extends Package implements PhivePackageInterface {

    public function __construct() {
        parent::__construct('phive-signature', 'latest', 'latest');
    }

    public function getDistUrl() {
        return 'https://phar.io/releases/phive.phar.asc';
    }

    public function getDistUrls() {
        return [$this->getDistUrl()];
    }

    public function getInstallationSource() {
        return 'dist';
    }

    public function getInstallationPath() {
        return __DIR__ . '/../../bin/' . basename($this->getDistUrl());
    }
}
