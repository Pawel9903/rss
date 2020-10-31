<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Command;


use PawelGedRekrutacjaHRtec\Enum\CommandColorsEnum;
use PawelGedRekrutacjaHRtec\Model\CsvRow;
use PawelGedRekrutacjaHRtec\Model\Message;
use PawelGedRekrutacjaHRtec\Output\MessageOutput;

class AddingDataCsvFileCommand extends ReceiverCommand
{
    public function execute(): void
    {
        $filePath = "{$this->receiver->getParams()->getPath()}.csv";
        if (file_exists($filePath)) {
            $this->addingDataToFile($filePath);
        } else {
            MessageOutput::print(new Message('Unable to write data to file.', CommandColorsEnum::RED));
        }
    }

    private function addingDataToFile(string $filePath): void
    {
        try {
            $table = $this->receiver->getTable();
            $resource = fopen($filePath, 'a');
            if(!count(str_getcsv(file_get_contents($filePath)))) {
                fputcsv($resource, $table->getColumns());
            }
            $table->getRows()->map(
                fn(CsvRow $row) => fputcsv($resource, $row->toArray())
            );
            MessageOutput::print(new Message("Data saved successfully to {$filePath} !!!", CommandColorsEnum::GREEN));
        } catch (\Exception $e) {
            MessageOutput::print(new Message('Unable to write data to file.', CommandColorsEnum::RED));
        }
    }
}