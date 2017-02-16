<?php

namespace PharIo\Composer\Console;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InfoCommand extends BaseCommand {

    protected function configure() {
        $this
            ->setName('phive:info')
            ->setDescription('@todo')
            ->setHelp(<<<EOT
@todo The <info>phive:info</info> command needs a description.</info>
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $phiveBinary = new PhiveBinary(__DIR__ . '/../../bin/phive.phar');
        $output->writeln('Path to Phive: ' . $phiveBinary);
    }
}
