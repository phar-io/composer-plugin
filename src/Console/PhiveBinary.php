<?php
namespace PharIo\Composer\Console;

use PharIo\FileSystem\Filename;

class PhiveBinary extends Filename {

    public function __construct() {
        parent::__construct(__DIR__ . '/../../bin/phive.phar');
    }
}
