<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Factory;

use DI\Container;
use PawelGedRekrutacjaHRtec\Command\AddingDataCsvFileCommand;
use PawelGedRekrutacjaHRtec\Command\CreateCsvFileCommand;
use PawelGedRekrutacjaHRtec\Command\OverwriteDataCsvFileCommand;
use PawelGedRekrutacjaHRtec\Command\RssDownloadCommand;
use PawelGedRekrutacjaHRtec\CommandInvoker\CommandInvoker;
use PawelGedRekrutacjaHRtec\CommandInvoker\CsvStoreRssFileCommandInvoker;
use PawelGedRekrutacjaHRtec\Model\CsvStoreParams;
use PawelGedRekrutacjaHRtec\Model\Input;
use PawelGedRekrutacjaHRtec\Receiver\StoreCsvReceiver;

class CsvCreator
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container;
    }

    public function create(Input $input): ?CommandInvoker
    {
        $commandInvoker = new CsvStoreRssFileCommandInvoker;
        $receiver = new StoreCsvReceiver;
        $csvParams = new CsvStoreParams($input->findArgv(2), $input->findArgv(3));
        $receiver->setParams($csvParams);

        switch ($input->getName()) {
            case 'csv:simple':
                return $commandInvoker
                    ->setOnDownloadRss(new RssDownloadCommand($receiver))
                    ->setOnCreateFile(new CreateCsvFileCommand($receiver))
                    ->setOnStoreDataToFile(new OverwriteDataCsvFileCommand($receiver));
            case 'csv:extended':
                return $commandInvoker
                    ->setOnDownloadRss(new RssDownloadCommand($receiver))
                    ->setOnCreateFile(new CreateCsvFileCommand($receiver))
                    ->setOnStoreDataToFile(new AddingDataCsvFileCommand($receiver));
            default:
                return null;
        }
    }
}