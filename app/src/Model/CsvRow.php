<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Model;

class CsvRow
{
    private string $title;
    private string $description;
    private string $link;
    private string $pubDate;
    private string $creator;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
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

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getPubDate(): string
    {
        return $this->pubDate;
    }

    public function setPubDate(string $pubDate): self
    {
        $this->pubDate = $pubDate;
        return $this;
    }

    public function getCreator(): string
    {
        return $this->creator;
    }

    public function setCreator(string $creator): self
    {
        $this->creator = $creator;
        return $this;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}