<?php

namespace PharIo\Composer\Tests\Unit\Installer;

use PharIo\Composer\Installer\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase {

    public function testCanConfigureGpgHomeViaOption() {
        $configuration = new Configuration(['gpg-home' => '/new/home']);
        $this->assertEquals('/new/home', $configuration->getGPGHomeDirectory());
    }

    public function testGpgHomeIsUserHomeDirectoryIfNotSet() {
        $configuration = new Configuration([]);
        $this->assertEquals(getenv('HOME'), $configuration->getGPGHomeDirectory());
    }

    public function testCanConfigureGpgBinaryViaOption() {
        $configuration = new Configuration(['gpg-binary' => '/path/to/binary']);
        $this->assertEquals('/path/to/binary', $configuration->getGPGBinaryPath());
    }

    public function testGpgBinaryIsNullByDefault() {
        $configuration = new Configuration([]);
        $this->assertNull($configuration->getGPGBinaryPath());
    }
}