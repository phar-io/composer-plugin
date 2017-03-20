<?php
namespace PharIo\Composer\Tests\Integration\Installer;

use Composer\IO\ConsoleIO;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\HelperSet;
use PharIo\Composer\Installer\Installer;

class InstallerTest extends \PHPUnit_Framework_TestCase {

    public function testCanDownloadPhivePackageAndSignature() {
        $composerIO = new ConsoleIO(new ArrayInput([]), new ConsoleOutput, new HelperSet);

        $installer = new Installer(\Composer\Factory::create($composerIO), $composerIO);
        $installer->install();

        $this->assertTrue(file_exists(__DIR__ . '/../../../bin/phive.phar'));
        $this->assertTrue(file_exists(__DIR__ . '/../../../bin/phive.phar.asc'));
        $this->assertTrue(is_executable(__DIR__ . '/../../../bin/phive.phar'));
    }
}
