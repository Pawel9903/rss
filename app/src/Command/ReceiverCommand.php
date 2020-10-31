<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\Command;

use PawelGedRekrutacjaHRtec\Receiver\Receiver;
use PawelGedRekrutacjaHRtec\Receiver\StoreCsvReceiver;

abstract class ReceiverCommand implements Command
{
    /**
     * @var Receiver|StoreCsvReceiver
     */
    protected Receiver $receiver;

    public function __construct(Receiver $receiver)
    {
        $this->receiver = $receiver;
    }
}