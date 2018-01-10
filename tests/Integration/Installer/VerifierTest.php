<?php
namespace PharIo\Composer\Tests\Integration\Installer;

use PharIo\Composer\Installer\Verifier;
use PharIo\Composer\Tests\Fixtures\CorruptPackage;
use PharIo\Composer\Tests\Fixtures\CorruptSignaturePackage;
use PharIo\FileSystem\Filename;
use Symfony\Component\Process\ExecutableFinder;

final class VerifierTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Verifier
     */
    private $verifier;

    public function setUp() {
        $gpgBinary = new Filename((new ExecutableFinder)->find('gpg'));

        if (false === $gpgBinary->exists()) {
            $this->fail('Could not find a GPG binary!');
        }

        $this->verifier = new Verifier($gpgBinary, getenv('HOME'));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testAnExceptionIsThrownIfVerificationFails() {
        $this->verifier->verify(new CorruptSignaturePackage, new CorruptPackage);
    }

    public function testCanImportAKey() {
        $this->verifier->importKey(file_get_contents(__DIR__ . '/../../../src/Resources/PharIo.pubkey'));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testAnExceptionIsThrownIfImportFailed() {
        $this->verifier->importKey(file_get_contents(__DIR__ . '/../../Fixtures/corrupt.pubkey'));
    }
}
