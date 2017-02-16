<?php

namespace PharIo\Composer\Console;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends BaseCommand {

    protected function configure() {
        $this
            ->setName('phive:run')
            ->setDescription('@todo')
            ->addArgument('arguments', InputArgument::OPTIONAL, '@todo', 'help')
            ->setHelp(<<<EOT
@todo The <info>phive:run</info> command needs a description.</info>
@example <info>phive:run install phpunit</info>
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('[WIP]');
        $phiveBinary = new PhiveBinary(__DIR__ . '/../../bin/phive.phar');
        $output->writeln(sprintf('%s %s', $phiveBinary, $input->getArgument('arguments')));
    }
}
