> :warning: __ARCHIVED__ :warning:
>
> This repository contains a PoC implemenation of a composer plugin which aimed to provide a custom command to integrate phive into composer.
> The idea though was abandoned and this repository now only remains as a read-only view in case anyone wants to have a look at the source code.
>
> __DO NOT USE IN PRODUCTION__ - It's unsupported, likely insecure and may not even work with current versions of composer :warning:

## composer-plugin

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
