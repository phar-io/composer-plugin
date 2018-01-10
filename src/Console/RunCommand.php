<?php
namespace PharIo\Composer\Console;

use Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends BaseCommand {

    protected function configure() {
        $this
            ->setName('phive:run')
            ->setDescription('Runs Phive with given parameters and options.')
            ->setHelp(<<<EOT
The <info>phive:run</info> command run's internally the phive.phar with the given parameters.
So for example to a simple command to install PHPUnit can look like this: 
<info>phive:run install phpunit</info>

You can also add any possible option to this command. So for example if you want to
install the Phar into a special directory like "bin" and you want a copy instead of a symlink:
<info>phive:run install --copy --target bin phpunit</info>

To see all options please run the following command:
<info>phive:run help</info>
EOT
            )
            ->ignoreValidationErrors();
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $phiveBinary = new PhiveBinary;

        $argv = $_SERVER['argv'];
        array_shift($argv);

        $parameters = implode(' ', array_diff($argv, [$this->getName()]));
        passthru(sprintf('%s %s', $phiveBinary, $parameters));
    }
}
