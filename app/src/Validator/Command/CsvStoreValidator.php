<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Validator\Command;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PawelGedRekrutacjaHRtec\Enum\CommandColorsEnum;
use PawelGedRekrutacjaHRtec\Model\Input;
use PawelGedRekrutacjaHRtec\Model\Message;

class CsvStoreValidator implements CommandValidator
{
    /**
     * @param Input $input
     * @return Collection&Message[]
     */
    public function validate(Input $input): Collection
    {
        $errors = new ArrayCollection();

        if (!empty($input->findArgv(2)) && filter_var($input->findArgv(2), FILTER_VALIDATE_URL) === FALSE) {
            $msg = "Not a valid URL argument in command: {$input->printInput()}";
            $errors->add(new Message($msg, CommandColorsEnum::RED));
        }

        if ($input->length() < 3) {
            $msg = "The URL argument is missing in command: {$input->printInput()}";
            $errors->add(new Message($msg, CommandColorsEnum::YELLOW));
        }

        if ($input->length() < 4) {
            $msg = "The PATH argument is missing in command: {$input->printInput()}";
            $errors->add(new Message($msg, CommandColorsEnum::YELLOW));
        }

        if ($input->length() > 4) {
            $msg = "Too many arguments in command: {$input->printInput()}";
            $errors->add(new Message($msg, CommandColorsEnum::YELLOW));
        }

        return $errors;
    }
}