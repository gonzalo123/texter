<?php

namespace Texter\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Texter\Suite;

class SuiteCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('texter:run')
            ->setDescription('Run text suite')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'Where are your tests?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path   = $input->getArgument('path');
        $finder = new Finder();
        $finder->files()->in($path);

        foreach ($finder as $file) {
            $filePath = $file->getRealpath();
            Suite::$filePath = $filePath;
            include $filePath;
        }

        $errors = Suite::getErrors();

        if (count($errors) == 0) {
            $output->writeln("<fg=black;bg=green>No Errors (" . Suite::$describeCount . " describes)</fg=black;bg=green>");
        } else {
            $i = 0;
            foreach ($errors as $error) {
                $i++;
                $output->writeln("<error>Error #{$i} {$error->getName()}</error>");
                $output->writeln("<error>" . $error->getException()->getMessage() . "</error>");
                $output->writeln(" at file: {$error->getFile()} in line {$error->getLine()}");
                foreach ($error->getParameters() as $k => $v) {
                    $output->writeln("  {$k}: {$v}");
                }
                $output->writeln("");
            }
            $output->writeln("");
            $output->writeln("<error>{$i} Errors detected (" . Suite::$describeCount . " describes)</error>");
        }
    }
}