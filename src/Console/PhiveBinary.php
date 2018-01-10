<?php
namespace PharIo\Composer\Console;

use PharIo\Composer\Common\PhiveBinaryException;
use PharIo\FileSystem\Filename;

class PhiveBinary extends Filename {

    public function __construct($binaryPath = __DIR__ . '/../../bin/phive.phar') {
        parent::__construct($binaryPath);
    }

    public function getVersion() {
        $output = [];
        exec(sprintf('%s %s', $this->asString(), 'version'), $output);

        return $output[0];
    }
}
