<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Factory;

use PawelGedRekrutacjaHRtec\CommandInvoker\CommandInvoker;
use PawelGedRekrutacjaHRtec\Config;
use PawelGedRekrutacjaHRtec\Model\CommandInfo;
use PawelGedRekrutacjaHRtec\Model\Input;
use PawelGedRekrutacjaHRtec\Model\Message;
use PawelGedRekrutacjaHRtec\Output\CommandInfoOutput;
use PawelGedRekrutacjaHRtec\Output\MessageOutput;
use PawelGedRekrutacjaHRtec\Validator\Command\CsvStoreValidator;

class CommandInvokerFactory
{
    private CsvCreator $csvCreator;
    private CsvStoreValidator $csvStoreValidator;

    public function __construct(CsvCreator $csvCreator, CsvStoreValidator $csvStoreValidator)
    {
        $this->csvCreator = $csvCreator;
        $this->csvStoreValidator = $csvStoreValidator;
    }

    public function tryCreateInstance(Input $input): ?CommandInvoker
    {
        $commandInfo = Config::findCommandInfo($input->getName());
        switch ($commandInfo->getPrefix()) {
            case 'csv':
                return $this->validateCsvInput($commandInfo, $input)
                    ? $this->csvCreator->create($input)
                    : null;
            default:
                CommandInfoOutput::printCommandNotFoundInfo($input);
                return null;
        }
    }

    private function validateCsvInput(CommandInfo $commandInfo, Input $input): bool
    {
        $errors = $this->csvStoreValidator->validate($input);
        if (!$errors->isEmpty()) {
            MessageOutput::printAll($errors);
            MessageOutput::print(new Message(''));
            CommandInfoOutput::printHelp($commandInfo);
            return false;
        }
        return true;
    }
}