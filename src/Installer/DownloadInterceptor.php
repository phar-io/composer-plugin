<?php
namespace PharIo\Composer\Installer;

use Composer\Downloader\DownloaderInterface;
use Composer\Package\PackageInterface;
use Composer\Util\Filesystem;
use Composer\Util\Silencer;

/**
 * Adapter for the internal Composer file-downloader to avoid the $path directory cleanup
 * and provide file renaming.
 */
class DownloadInterceptor {

    /**
     * @var DownloaderInterface
     */
    private $downloader;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @param DownloaderInterface $downloader
     * @param Filesystem          $filesystem
     */
    public function __construct(DownloaderInterface $downloader, Filesystem $filesystem) {
        $this->downloader = $downloader;
        $this->filesystem = $filesystem;
    }

    /**
     * @param PackageInterface $package
     * @param string           $path
     */
    public function download(PackageInterface $package, $path) {
        $tmpFile = $this->downloader->download($package, sys_get_temp_dir());
        $this->filesystem->rename($tmpFile, $path . '/' . basename($package->getDistUrl()));

        // be sure that phive.phar is executable
        Silencer::call('chmod', $path . '/' . basename($package->getDistUrl()), 0777 & ~umask());
    }
}
