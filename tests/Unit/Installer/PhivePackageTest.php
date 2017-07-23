<?php
namespace PharIo\Composer\Tests\Unit\Installer;

use PharIo\Composer\Installer\PhivePackage;

class PhivePackageTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var PhivePackage
     */
    private $package;

    /**
     * {inheritDoc}
     */
    public function setUp() {
        $this->package = new PhivePackage;
    }

    public function testCanGetName() {
        $this->assertEquals('phive', $this->package->getName());
    }

    public function testCanGetVersion() {
        $this->assertEquals('latest', $this->package->getVersion());
    }

    public function testCanGetDistUrl() {
        $this->assertEquals('https://phar.io/releases/phive.phar', $this->package->getDistUrl());
    }

    public function testCanGetDistUrls() {
        $this->assertCount(1, $this->package->getDistUrls());
    }

    public function testCanGetInstallationSource() {
        $this->assertEquals('dist', $this->package->getInstallationSource());
    }

    public function testCanGetInstallationPath() {
        $this->assertContains('bin/phive.phar', $this->package->getInstallationPath());
    }
}
