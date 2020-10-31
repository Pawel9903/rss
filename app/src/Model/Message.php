<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Model;

use PawelGedRekrutacjaHRtec\Enum\CommandColorsEnum;

class Message
{
    private string $contents;
    private string $color;

    public function __construct(string $contents, string $color = null)
    {
        $this->contents = $contents;
        $this->color = $color ?? CommandColorsEnum::NC;
    }

    public function getContents(): string
    {
        return $this->contents;
    }

    public function setContents(string $contents): self
    {
        $this->contents = $contents;
        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }
}