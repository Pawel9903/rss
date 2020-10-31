<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\CommandInvoker;

use PawelGedRekrutacjaHRtec\Command\Command;

class CsvStoreRssFileCommandInvoker implements CommandInvoker
{
    private Command $onDownloadRss;
    private Command $onCreateFile;
    private Command $onStoreDataToFile;

    public function setOnDownloadRss(Command $command): self
    {
        $this->onDownloadRss = $command;
        return $this;
    }

    public function setOnCreateFile(Command $command): self
    {
        $this->onCreateFile = $command;
        return $this;
    }

    public function setOnStoreDataToFile(Command $command): self
    {
        $this->onStoreDataToFile = $command;
        return $this;
    }

    public function run(): void
    {
        $this->onDownloadRss->execute();
        $this->onCreateFile->execute();
        $this->onStoreDataToFile->execute();
    }
}