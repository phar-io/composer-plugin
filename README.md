# composer-plugin

This plugin integrates Phive to Composer.

## Requirement

* [Composer](https://getcomposer.org/doc/00-intro.md#introduction)

## Installation

```
composer global require phar-io/composer-plugin
```

## Usage

After a successful installation there are two new commands in your Composer CLI available.
With ``phive:run`` you can now install Phar files directly via Composer.

For example PHPUnit:
```
composer phive:run install phpunit
```

And with ``phive:info`` you can see some information's about your current Phive installation.
