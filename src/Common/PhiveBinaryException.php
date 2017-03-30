<?php

namespace PharIo\Composer\Common;

final class PhiveBinaryException extends \RuntimeException {

    public static function notExist($filename) {
        return self::create('The Phive binary under %s are not exist!');
    }

    public static function notExecutable() {
        return self::create('The Phive binary must be executable!');
    }

    private static function create($message) {
        return new static($message);
    }
}
