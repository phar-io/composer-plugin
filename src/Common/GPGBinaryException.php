<?php
namespace PharIo\Composer\Common;

final class GPGBinaryException extends \RuntimeException {

    public static function notFound() {
        return self::create('No GPG binary found!');
    }

    private static function create($message) {
        return new static($message);
    }
}
