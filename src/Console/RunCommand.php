<?php

namespace PharIo\Composer\Console;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends BaseCommand {

    protected function configure() {
        $this
            ->setName('phive:run')
            ->setDescription('@todo')
            ->setHelp(<<<EOT
@todo The <info>phive:run</info> command needs a description.</info>
@example <info>phive:run install phpunit</info>
EOT
            )
            ->ignoreValidationErrors();
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $phiveBinary = new PhiveBinary;

        if (false === $phiveBinary->exists()) {
            return $output->writeln('@todo');
        }

        $argv = $_SERVER['argv'];
        array_shift($argv);

        $parameters = implode(' ', array_diff($argv, [$this->getName()]));
        passthru(sprintf('%s %s', $phiveBinary, $parameters));
    }
}
