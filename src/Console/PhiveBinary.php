<?php
namespace PharIo\Composer\Console;

use PharIo\Composer\Common\PhiveBinaryException;
use PharIo\FileSystem\Filename;

class PhiveBinary extends Filename {

    public function __construct($binaryPath = __DIR__ . '/../../bin/phive.phar') {
        parent::__construct($binaryPath);

        if (false === $this->exists()) {
            throw PhiveBinaryException::notExist($binaryPath);
        }
    }
}
