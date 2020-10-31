<?php declare(strict_types=1);
error_reporting(0);

use PawelGedRekrutacjaHRtec\Facade\CommandExecutor;
use PawelGedRekrutacjaHRtec\Model\Input;

require __DIR__ . '/../vendor/autoload.php';

$commandExecutor = new CommandExecutor;
$commandExecutor->execute(new Input($argv));
