<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class CsvTable
{
    private array $columns = [];

    /**
     * @var Collection&CsvRow[]
     */
    private Collection $rows;

    /**
     * CsvTable constructor.
     * @param Collection&CsvRow[]|null $rows
     */
    public function __construct(Collection $rows = null)
    {
        $this->rows = $rows ?? new ArrayCollection;
        $this->columns = array_keys($rows->first()->toArray());
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function setColumns(array $columns): CsvTable
    {
        $this->columns = $columns;
        return $this;
    }

    public function getRows(): Collection
    {
        return $this->rows;
    }

    public function setRows($rows): self
    {
        $this->rows->map(fn(CsvRow $model) => $this->addRow($model));
        return $this;
    }

    public function addRow(CsvRow $model): self
    {
        if (!$this->rows->contains($model)) {
            $this->rows->add($model);
        }
        return $this;
    }
}