<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\test;

use PawelGedRekrutacjaHRtec\CommandInvoker\CsvStoreRssFileCommandInvoker;
use PawelGedRekrutacjaHRtec\Factory\CsvCreator;
use PawelGedRekrutacjaHRtec\Model\Input;
use PHPUnit\Framework\TestCase;

class CsvCreatorTest extends TestCase
{
    protected CsvCreator $creator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->creator = new CsvCreator;
    }

    public function testWhenPassCorrectInputExpectInvokerInstance(): void
    {
        $input = new Input(['./console.php', 'csv:simple', 'http://www.google.com', '/home/app']);
        $invoker = $this->creator->create($input);
        $this->assertInstanceOf(CsvStoreRssFileCommandInvoker::class, $invoker);
    }

    public function testWhenPassIncorrectInputExpectNullValue(): void
    {
        $input = new Input(['./console.php', 'csv', 'http://www.google.com', '/home/app']);
        $invoker = $this->creator->create($input);
        $this->assertNull($invoker);
    }
}