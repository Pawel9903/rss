<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Output;

use Doctrine\Common\Collections\Collection;
use PawelGedRekrutacjaHRtec\Enum\CommandColorsEnum;
use PawelGedRekrutacjaHRtec\Model\Message;

class MessageOutput
{
    public static function printAll(Collection $msgs): void
    {
        $msgs->map(fn(Message $msg) => MessageOutput::print($msg));
    }

    public static function print(Message $msg): void
    {
        echo $msg->getColor() . $msg->getContents() . CommandColorsEnum::NC . PHP_EOL;
    }
}