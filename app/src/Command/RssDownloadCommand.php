<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Command;

use DI\Container;
use Doctrine\Common\Collections\ArrayCollection;
use PawelGedRekrutacjaHRtec\Enum\CommandColorsEnum;
use PawelGedRekrutacjaHRtec\Model\CsvTable;
use PawelGedRekrutacjaHRtec\Model\Message;
use PawelGedRekrutacjaHRtec\Output\MessageOutput;
use PawelGedRekrutacjaHRtec\Receiver\Receiver;
use PawelGedRekrutacjaHRtec\Transformer\CsvRowTransformer;
use SimpleXMLElement;

class RssDownloadCommand extends ReceiverCommand
{
    private CsvRowTransformer $transformer;

    public function __construct(Receiver $receiver)
    {
        parent::__construct($receiver);
        $container = new Container;
        $this->transformer = $container->get(CsvRowTransformer::class);
    }

    public function execute(): void
    {
        $xml = $this->downloadRssXml();
        $table = $this->createTableByXml($xml);
        $this->receiver->setTable($table);
    }

    private function downloadRssXml(): ?SimpleXMLElement
    {
        $url = $this->receiver->getParams()->getUrl();
        $xml = simplexml_load_file($url);
        MessageOutput::print(new Message("Fetching data from {$url}...", CommandColorsEnum::GREEN));
        if ($xml === false) {
            MessageOutput::print(new Message('Data cannot be retrieved from the given address.', CommandColorsEnum::RED));
            die();
        } else {
            MessageOutput::print(new Message('The data has been successfully downloaded.', CommandColorsEnum::GREEN));
        }
        return $xml;
    }

    private function createTableByXml(?SimpleXMLElement $xml): CsvTable
    {
        $rows = new ArrayCollection;
        foreach ($xml->channel->item as $item) {
            $row = $this->transformer->transformToModel($item);
            $rows->add($row);
        }
        return new CsvTable($rows);
    }
}