<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Model;

class Input
{
    private string $name;
    private array $argv;

    public function __construct(array $argv)
    {
        $this->argv = $argv;
        $this->name = $argv[1] ?? '';
    }

    public function findArgv(int $key): ?string
    {
        return $this->argv[$key] ?? null;
    }

    public function getArgv(): array
    {
        return $this->argv;
    }

    public function setArgv(array $argv): self
    {
        $this->argv = $argv;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPrefix(): string
    {
        return explode(':', $this->name)[0] ?? '';
    }

    public function getOption(): string
    {
        return explode(':', $this->name)[1] ?? '';
    }

    public function length(): int
    {
        return count($this->argv);
    }

    public function printInput(): string
    {
        return implode(' ', $this->argv);
    }
}