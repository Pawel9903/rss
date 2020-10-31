<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec;

use Dallgoot\Yaml;
use Dallgoot\Yaml\Compact;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PawelGedRekrutacjaHRtec\Model\CommandInfo;
use PawelGedRekrutacjaHRtec\Transformer\CommandInfoTransformer;

class Config
{
    /**
     * @return Collection&CommandInfo[]
     * @throws \Exception
     */
    public static function getCommandsInfo(): Collection
    {
        $commands = new ArrayCollection;
        $transformer = new CommandInfoTransformer;
        $constants = Yaml::parseFile(__DIR__ . '/constants.yml');
        /** @var Compact $command */
        foreach ($constants->commands as $command) {
            $commands->add($transformer->transformToModel($command->getArrayCopy()));
        }

        return $commands;
    }

    public static function findCommandInfo(string $name): CommandInfo
    {
        $searchesInfo = Config::getCommandsInfo()->filter(
            fn(CommandInfo $model): bool => $model->getName() === $name
        );
        return $searchesInfo->first() ?: new CommandInfo;
    }
}