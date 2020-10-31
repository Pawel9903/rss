<?php declare(strict_types=1);


namespace PawelGedRekrutacjaHRtec\Transformer;

use PawelGedRekrutacjaHRtec\Model\CommandInfo;
use PawelGedRekrutacjaHRtec\Model\CsvRow;

class CommandInfoTransformer extends Transformer
{
    /**
     * @param array $data
     * @param CommandInfo|null $instance
     * @return CommandInfo
     */
    public function transformToModel($data, $instance = null): CommandInfo
    {
        $model = $instance instanceof CsvRow ? $instance : new CommandInfo;

        return $model
            ->setName((string)$data['name'] ?? '')
            ->setDescription((string)$data['description'] ?? '')
            ->setParameters((string)$data['parameters'] ?? '');
    }
}