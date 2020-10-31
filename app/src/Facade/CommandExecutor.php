<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Facade;

use DI\Container;
use PawelGedRekrutacjaHRtec\CommandInvoker\CommandInvoker;
use PawelGedRekrutacjaHRtec\Factory\CommandInvokerFactory;
use PawelGedRekrutacjaHRtec\Model\Input;
use PawelGedRekrutacjaHRtec\Output\CommandInfoOutput;

class CommandExecutor
{
    private CommandInvokerFactory $commandInvokerFactory;

    public function __construct()
    {
        $container = new Container;
        $this->commandInvokerFactory = $container->get(CommandInvokerFactory::class);
    }

    public function execute(Input $input): void
    {
        if ($input->length() > 1) {
            $invoker = $this->commandInvokerFactory->tryCreateInstance($input);
            $invoker instanceof CommandInvoker
                ? $invoker->run()
                : null;
        } else {
            CommandInfoOutput::printFullCommandsInfo();
        }
    }
}