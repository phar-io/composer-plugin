<?php

namespace PharIo\Composer\Installer;

class Configuration {

    /**
     * @var array
     */
    private $options = [];

    /**
     * @param array $options
     */
    public function __construct(array $options = []) {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getGPGHomeDirectory() {
        if (array_key_exists('gpg-home', $this->options)) {
            return $this->options['gpg-home'];
        }

        return getenv('HOME');
    }

    /**
     * @return string|null
     */
    public function getGPGBinaryPath() {
        if (array_key_exists('gpg-binary', $this->options)) {
            return $this->options['gpg-binary'];
        }

        return null;
    }
}
