<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Output;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PawelGedRekrutacjaHRtec\Config;
use PawelGedRekrutacjaHRtec\Enum\CommandColorsEnum;
use PawelGedRekrutacjaHRtec\Model\CommandInfo;
use PawelGedRekrutacjaHRtec\Model\Input;
use PawelGedRekrutacjaHRtec\Model\Message;

class CommandInfoOutput
{

    public static function printCommandNotFoundInfo(Input $input): void
    {
        MessageOutput::print(new Message('Command ' . $input->printInput() . ' not found ', CommandColorsEnum::RED));
        MessageOutput::print(new Message(''));
        CommandInfoOutput::printFullCommandsInfo();
    }

    public static function printFullCommandsInfo(): void
    {
        MessageOutput::print(new Message('Commands: '));
        CommandInfoOutput::print(Config::getCommandsInfo());
    }

    public static function printHelp(CommandInfo $commandInfo): void
    {
        MessageOutput::print(new Message('Help:'));
        CommandInfoOutput::print(new ArrayCollection([$commandInfo]));
    }

    public static function print(Collection $commandInfo): void
    {
        $commandInfo->map(function (CommandInfo $commandInfo): void {
            echo $commandInfo->getName() . ' ' . $commandInfo->getParameters() . ' - ' . $commandInfo->getDescription() . PHP_EOL;
        });
    }
}