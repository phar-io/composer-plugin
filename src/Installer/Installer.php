<?php
namespace PharIo\Composer\Installer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Util\Filesystem;
use Composer\Util\Silencer;
use PharIo\Composer\Common\GPGBinaryException;
use Symfony\Component\Process\ExecutableFinder;

class Installer {

    /**
     * @var Composer
     */
    private $composer;

    /**
     * @var IOInterface
     */
    private $io;

    /**
     * @param Composer    $composer
     * @param IOInterface $io
     */
    public function __construct(Composer $composer, IOInterface $io) {
        $this->composer = $composer;
        $this->io = $io;
    }

    /**
     * @param Configuration $configuration
     */
    public function install(Configuration $configuration) {
        $fileDownloader = $this->composer->getDownloadManager()->getDownloader('file');
        $downloader = new DownloadInterceptor($fileDownloader, new Filesystem);

        $phivePackage = new PhivePackage;
        $signaturePackage = new PhiveSignaturePackage;

        try {
            $gpgBinary = $configuration->getGPGBinaryPath();

            if (null === $gpgBinary) {
                $gpgBinary = (new ExecutableFinder)->find('gpg');
            }

            if (null === $gpgBinary) {
                throw GPGBinaryException::notFound();
            }

            $downloader->download($phivePackage);
            $this->io->write('');
            $downloader->download($signaturePackage);

            $this->io->write('');
            $this->io->write('    <comment>"phive.phar" and "phive.phar.asc" successfully downloaded!</comment>');

            $verifier = new Verifier($gpgBinary, $configuration->getGPGHomeDirectory());
            $verifier->importKey(file_get_contents(__DIR__ . '/../Resources/PharIo.pubkey'));
            $verifier->verify($phivePackage, $signaturePackage);

            $this->io->write('<info>GPG Verification successful!</info>');

            // @todo differentiate exceptions
        } catch (\Exception $exception) {
            Silencer::call('unlink', $phivePackage->getInstallationPath());
            Silencer::call('unlink', $signaturePackage->getInstallationPath());

            $this->io->writeError($exception->getMessage());
            return 1;
        }

        $this->io->write('');
        $this->io->write('    <comment>You can now run phive via "composer phive:run"!</comment>');
        return 0;
    }
}
