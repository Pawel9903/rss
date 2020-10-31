<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Model;

class CommandInfo
{
    private string $name = '';
    private string $parameters = '';
    private string $description = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getParameters(): string
    {
        return $this->parameters;
    }

    public function setParameters(string $parameters): self
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
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
}