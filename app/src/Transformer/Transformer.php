<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Transformer;

abstract class Transformer
{
    abstract public function transformToModel($data, $instance = null): object;
}