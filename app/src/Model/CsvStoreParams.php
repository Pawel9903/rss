<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Model;

class CsvStoreParams
{
    private string $url;
    private string $path;

    public function __construct(string $url, string $path)
    {
        $this->url = $url;
        $this->path = $path;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }


}