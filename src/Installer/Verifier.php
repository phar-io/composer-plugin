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
     * @param Filename $gpgBinary
     * @param string   $homeDirectory
     *
     * @throws \InvalidArgumentException
     * @throws DirectoryException
     */
    public function __construct(Filename $gpgBinary, $homeDirectory) {
        $factory = new Factory($gpgBinary);
        $this->gpg = $factory->createGnuPG(new Directory($homeDirectory));
    }

    /**
     * @param string $key
     *
     * @throws \RuntimeException
     */
    public function importKey($key) {
        if (false === $this->gpg->import($key)) {
            throw new \RuntimeException('Could not import needed GPG key!');
        }
    }

    /**
     * @param PhivePackageInterface $signaturePackage
     * @param PhivePackageInterface $phivePackage
     *
     * @throws \RuntimeException
     */
    public function verify(PhivePackageInterface $signaturePackage, PhivePackageInterface $phivePackage) {
        $result = $this->gpg->verify(
            file_get_contents($signaturePackage->getInstallationPath()),
            file_get_contents($phivePackage->getInstallationPath())
        );

        if (false === $result) {
            throw new \RuntimeException(
                sprintf('Verification between "%s" and "%s" are failed!', $signaturePackage->getName(), $phivePackage->getName()
            ));
        }
    }
}
