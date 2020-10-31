<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Validator\Command;

use Doctrine\Common\Collections\Collection;
use PawelGedRekrutacjaHRtec\Model\Input;

interface CommandValidator
{
    public function validate(Input $input): Collection;
}