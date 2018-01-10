<?php
namespace PharIo\Composer\Console;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InfoCommand extends BaseCommand {

    protected function configure() {
        $this
            ->setName('phive:info')
            ->setDescription('Displays some information about Phive.')
            ->setHelp(<<<EOT
The <info>phive:info</info> command displays some information like current version and
binary location.</info>
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $binary = new PhiveBinary;

        $table = new Table($output);
        $table
            ->setRows([
                ['Current version', $binary->getVersion()],
                ['Path to Phive', $binary->withAbsolutePath()],
                new TableSeparator(),
                ['GPG public key Id', '9B2D5D79'],
                ['GPG public key Fingerprint',  '6AF7 2527 0AB8 1E04 D794 4254 9D8A 98B2 9B2D 5D79'],
            ])
            ->render();
    }
}
