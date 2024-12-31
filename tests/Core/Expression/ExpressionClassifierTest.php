<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Expression;

use Filczek\PhpPolishNotation\Core\Expression\Classifier\DefaultExpressionClassifier;
use Filczek\PhpPolishNotation\MathNotationDataProvider;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ExpressionClassifierTest extends TestCase
{
    #[Test]
    #[DataProvider('examples')]
    public function classify(array $expression, ExpressionNotation $expected): void
    {
        $actual = (new DefaultExpressionClassifier())->notationOf($expression);

        $this->assertSame($expected, $actual);
    }

    public static function examples(): Generator
    {
        foreach (MathNotationDataProvider::data() as $item) {
            foreach ($item as $key => $expression) {
                $expected = ExpressionNotation::from($key);
                $string_expression = $expression['string_expression'];
                $array_expression = $expression['array_expression'];

                yield "expects '$string_expression' to be '$key'" => [$array_expression, $expected];
            }
        }
    }
}
