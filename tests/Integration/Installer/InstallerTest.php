<?php
namespace PharIo\Composer\Tests\Integration\Installer;

use Composer\IO\ConsoleIO;
use PharIo\Composer\Installer\Configuration;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\HelperSet;
use PharIo\Composer\Installer\Installer;

final class InstallerTest extends \PHPUnit_Framework_TestCase {

    public function testCanDownloadPhivePackageAndSignature() {
        $composerIO = new ConsoleIO(new ArrayInput([]), new ConsoleOutput, new HelperSet);

        $installer = new Installer(\Composer\Factory::create($composerIO), $composerIO);
        $result = $installer->install(new Configuration([]));

        $this->assertFileExists(__DIR__ . '/../../../bin/phive.phar');
        $this->assertFileExists(__DIR__ . '/../../../bin/phive.phar.asc');
        $this->assertTrue(is_executable(__DIR__ . '/../../../bin/phive.phar'));
        $this->assertEquals(0, $result);
    }

    public function testInstallAreFailedIfGpgBinaryDoesNotExist()
    {
        $composerIO = new ConsoleIO(new ArrayInput([]), new ConsoleOutput, new HelperSet);

        $installer = new Installer(\Composer\Factory::create($composerIO), $composerIO);
        $result = $installer->install(new Configuration(['gpg-binary' => '/not/exist']));

        $this->assertEquals(1, $result);
    }
}
