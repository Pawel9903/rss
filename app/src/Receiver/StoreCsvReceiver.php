<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Receiver;

use PawelGedRekrutacjaHRtec\Model\CsvStoreParams;
use PawelGedRekrutacjaHRtec\Model\CsvTable;

class StoreCsvReceiver implements Receiver
{
    private CsvTable $table;
    private CsvStoreParams $params;
    private string $writeFileMode;

    public function getTable(): CsvTable
    {
        return $this->table;
    }

    public function setTable(CsvTable $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function getParams(): CsvStoreParams
    {
        return $this->params;
    }

    public function setParams(CsvStoreParams $params): self
    {
        $this->params = $params;
        return $this;
    }

    public function getWriteFileMode(): string
    {
        return $this->writeFileMode;
    }
}