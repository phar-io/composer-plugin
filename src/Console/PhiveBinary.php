<?php

namespace PharIo\Composer\Console;

class PhiveBinary {

    /**
     * @var \SplFileInfo
     */
    private $file;

    public function __construct($filename) {
        $this->file = new \SplFileInfo($filename);

        if (!$this->file->isFile()) {
            throw PhiveBinaryException::notExist($this->file->getRealPath());
        }

        if (!$this->file->isExecutable()) {
            throw PhiveBinaryException::notExecutable();
        }
    }

    public function __toString() {
        return $this->file->getRealPath();
    }
}
