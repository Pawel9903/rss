<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\test;

use PawelGedRekrutacjaHRtec\Model\Input;
use PawelGedRekrutacjaHRtec\Model\Message;
use PawelGedRekrutacjaHRtec\Validator\Command\CsvStoreValidator;
use PHPUnit\Framework\TestCase;

class CsvStoreValidatorTest extends TestCase
{
    protected CsvStoreValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new CsvStoreValidator;
    }

    public function testWhenValidateEmptyInputGetTwoErrors(): void
    {
        $input = new Input([]);
        $errors = $this->validator->validate($input);
        $this->assertFalse($errors->isEmpty());
        $this->assertSame($errors->count(), 2);
    }

    public function testWhenValidateEmptyInputGetUrlArgumentErrors(): void
    {
        $input = new Input([]);
        $errors = $this->validator->validate($input);
        /** @var Message $firstError */
        $firstErrorMessage = $errors->first()->getContents();
        $this->assertStringContainsString('URL', $firstErrorMessage);
    }

    public function testWhenValidateBadUrlInputGetInvalidUrlMessage(): void
    {
        $input = new Input(['./console.php', 'csv:simple', 'test', '/home/app']);
        $errors = $this->validator->validate($input);
        /** @var Message $firstError */
        $firstErrorMessage = $errors->first()->getContents();
        $this->assertStringContainsString('not a valid url', strtolower($firstErrorMessage));
    }

    public function testWhenValidateCorrectInputExpectEmptyErrorsCollection(): void
    {
        $input = new Input(['./console.php', 'csv:simple', 'http://www.google.com', '/home/app']);
        $errors = $this->validator->validate($input);
        /** @var Message $firstError */
        $this->assertTrue($errors->isEmpty());
    }
}