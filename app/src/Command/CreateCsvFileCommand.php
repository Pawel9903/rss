<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Command;

use PawelGedRekrutacjaHRtec\Enum\CommandColorsEnum;
use PawelGedRekrutacjaHRtec\Model\Message;
use PawelGedRekrutacjaHRtec\Output\MessageOutput;

class CreateCsvFileCommand extends ReceiverCommand
{
    public function execute(): void
    {
        $filePath = "{$this->receiver->getParams()->getPath()}.csv";
        if (!file_exists($filePath)) {
            $this->createFile($filePath);
        } else {
            MessageOutput::print(new Message('The file already exists', CommandColorsEnum::GREEN));
        }
    }

    private function createFile(string $filePath): void
    {
        $fp = fopen($filePath, 'w');
        if ($fp) {
            MessageOutput::print(new Message('The file was created successfully.', CommandColorsEnum::GREEN));
        } else {
            MessageOutput::print(new Message('The file could not be created at the given path.', CommandColorsEnum::RED));
            die();
        }
    }
}