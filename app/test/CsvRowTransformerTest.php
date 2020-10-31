<?php declare(strict_types=1);

namespace PawelGedRekrutacjaHRtec\test;

use PawelGedRekrutacjaHRtec\Model\CsvRow;
use PawelGedRekrutacjaHRtec\Transformer\CsvRowTransformer;
use PHPUnit\Framework\TestCase;

class CsvRowTransformerTest extends TestCase
{
    protected CsvRowTransformer $transformer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->transformer = new CsvRowTransformer;
    }

    public function testWhenPassNullExpectEmptyInstanceAndNotThrowError(): void
    {
        $model = $this->transformer->transformToModel(null);
        $this->assertInstanceOf(CsvRow::class, $model);
        $this->assertEmpty($model->getDescription());
    }
}