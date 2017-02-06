<?php

namespace PharIo\Composer\Installer\Packages;

use Composer\Package\Package;

class PhivePackage extends Package
{
    public function __construct()
    {
        parent::__construct('phive', 'latest', 'latest');
    }

    public function getDistUrl()
    {
        return 'https://phar.io/releases/phive.phar';
    }

    public function getDistUrls()
    {
        return [$this->getDistUrl()];
    }

    public function getInstallationSource()
    {
        return 'dist';
    }
}
