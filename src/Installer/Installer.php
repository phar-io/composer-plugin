<?php

namespace PharIo\Composer\Installer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Util\Filesystem;
use PharIo\Composer\Installer\Packages\PhivePackage;
use PharIo\Composer\Installer\Packages\PhiveSignaturePackage;

class Installer
{
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
    public function __construct(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
    }

    public function install()
    {
        $binaryDirectory = __DIR__ . '/../../bin';
        $fileDownloader = $this->composer->getDownloadManager()->getDownloader('file');

        $downloader = new Downloader($fileDownloader, new Filesystem);

        try {
            $downloader->download(new PhivePackage, $binaryDirectory);
            $downloader->download(new PhiveSignaturePackage, $binaryDirectory);
        } catch (\Exception $exception) {
            $this->io->writeError($exception->getMessage());
        }

        $this->io->write('');
        $this->io->write('    <comment>"phive.phar" and "phive.phar.asc" successfully downloaded!</comment>');
    }
}
