<?php

namespace App\Commands;

use App\Helpers\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartCommand extends Command {
    protected function configure() {
        $this->setName("start")
            ->setDescription("Start the main entry");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        ini_set("memory_limit", "-1");
        gc_enable();
        error_reporting(1);
        error_reporting(E_ALL);

        // Load the container
        $container = (new Container())->getContainer();
    }
}