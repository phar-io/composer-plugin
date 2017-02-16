<?php
namespace PharIo\Composer\Tests\Unit\Installer\Packages;

use PharIo\Composer\Installer\PhiveSignaturePackage;

class PhiveSignaturePackageTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var PhiveSignaturePackage
     */
    private $package;

    /**
     * {inheritDoc}
     */
    public function setUp() {
        $this->package = new PhiveSignaturePackage;
    }

    public function testCanGetName() {
        $this->assertEquals('phive-signature', $this->package->getName());
    }

    public function testCanGetVersion() {
        $this->assertEquals('latest', $this->package->getVersion());
    }

    public function testCanGetDistUrl() {
        $this->assertEquals('https://phar.io/releases/phive.phar.asc', $this->package->getDistUrl());
    }

    public function testCanGetDistUrls() {
        $this->assertCount(1, $this->package->getDistUrls());
    }

    public function testCanGetInstallationSource() {
        $this->assertEquals('dist', $this->package->getInstallationSource());
    }
}
