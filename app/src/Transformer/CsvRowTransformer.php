<?php declare(strict_types=1);


namespace PawelGedRekrutacjaHRtec\Transformer;

use PawelGedRekrutacjaHRtec\Model\CsvRow;
use PawelGedRekrutacjaHRtec\Translation\pl\Date;
use SimpleXMLElement;

class CsvRowTransformer extends Transformer
{
    /**
     * @param SimpleXMLElement $data
     * @param CsvRow|null $instance
     * @return CsvRow
     */
    public function transformToModel($data, $instance = null): CsvRow
    {
        $model = $instance instanceof CsvRow ? $instance : new CsvRow;

        return $model
            ->setCreator((string)$data->author ?? '')
            ->setDescription(strip_tags((string)$data->description ?? ''))
            ->setLink((string)$data->link ?? '')
            ->setPubDate($this->formatDate((string)$data->pubDate))
            ->setTitle((string)$data->title ?? '');
    }

    private function formatDate(string $date): string
    {
        $pubDateTime = new \DateTime((string)$date);
        $day = $pubDateTime->format('d');
        $month = strtolower(Date::$months[$pubDateTime->format('F')] ?? '');
        $year = $pubDateTime->format('Y');
        $time = $pubDateTime->format('H:i:s');
        return "{$day} {$month} {$year} {$time}";
    }
}