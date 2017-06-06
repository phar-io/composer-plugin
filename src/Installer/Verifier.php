<?php
namespace PharIo\Composer\Installer;

use PharIo\FileSystem\Directory;
use PharIo\FileSystem\DirectoryException;
use PharIo\FileSystem\Filename;
use PharIo\GnuPG\Factory;

class Verifier {

    /**
     * @var \Gnupg
     */
    private $gpg;

    /**
     * @param string $gpgBinary
     * @param string $homeDirectory
     *
     * @throws \InvalidArgumentException
     * @throws DirectoryException
     */
    public function __construct($gpgBinary, $homeDirectory) {
        $factory = new Factory(new Filename($gpgBinary));
        $this->gpg = $factory->createGnuPG(new Directory($homeDirectory));
    }

    public function importKey($key) {
        // @todo handle result
        $this->gpg->import($key);
    }

    public function verify(PhivePackageInterface $signaturePackage, PhivePackageInterface $phivePackage) {
        $result = $this->gpg->verify(
            file_get_contents($signaturePackage->getInstallationPath()),
            file_get_contents($phivePackage->getInstallationPath())
        );

        // @todo handle result
    }
}
