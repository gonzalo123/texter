<?php
include __DIR__ . '/../vendor/autoload.php';

use Texter\Command\SuiteCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new SuiteCommand);
$application->run();