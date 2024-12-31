<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Expressions\MathematicalExpression;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use stdClass;

class MathematicalOperatorPriorityTest extends TestCase
{
    #[Test]
    #[DataProvider('priorityOfExamples')]
    public function priorityOf(mixed $operator, int $expected): void
    {
        $actual = $this->prioritizesOperator()->priorityOf($operator);

        $this->assertSame($expected, $actual);
    }

    #[Test]
    #[DataProvider('hasHighestPriorityExamples')]
    public function hasHighestPriority(mixed $operator, bool $expected): void
    {
        $actual = $this->prioritizesOperator()->hasHighestPriority($operator);

        $this->assertSame($expected, $actual);
    }

    #[Test]
    #[DataProvider('hasLowestPriorityExamples')]
    public function hasLowestPriority(mixed $operator, bool $expected): void
    {
        $actual = $this->prioritizesOperator()->hasLowestPriority($operator);

        $this->assertSame($expected, $actual);
    }

    private function prioritizesOperator(): MathematicalOperatorPriority
    {
        return new MathematicalOperatorPriority();
    }

    public static function priorityOfExamples(): Generator
    {
        yield 'gets priority of ' . MathematicalOperators::Exponentiation->value . ' from enum' => [MathematicalOperators::Exponentiation, 3];
        yield 'gets priority of ' . MathematicalOperators::Exponentiation->value . ' from string' => [MathematicalOperators::Exponentiation->value, 3];

        yield 'gets priority of ' . MathematicalOperators::Multiplication->value . ' from enum' => [MathematicalOperators::Multiplication, 2];
        yield 'gets priority of ' . MathematicalOperators::Multiplication->value . ' from string' => [MathematicalOperators::Multiplication->value, 2];
        yield 'gets priority of ' . MathematicalOperators::Division->value . ' from enum' => [MathematicalOperators::Division, 2];
        yield 'gets priority of ' . MathematicalOperators::Division->value . ' from string' => [MathematicalOperators::Division->value, 2];

        yield 'gets priority of ' . MathematicalOperators::Addition->value . ' from enum' => [MathematicalOperators::Addition, 1];
        yield 'gets priority of ' . MathematicalOperators::Addition->value . ' from string' => [MathematicalOperators::Addition->value, 1];
        yield 'gets priority of ' . MathematicalOperators::Subtraction->value . ' from enum' => [MathematicalOperators::Subtraction, 1];
        yield 'gets priority of ' . MathematicalOperators::Subtraction->value . ' from string' => [MathematicalOperators::Subtraction->value, 1];

        yield 'gets default priority on object' => [new stdClass(), 0];
        yield 'gets default priority on array' => [[], 0];
        yield 'gets default priority on decimal string' => [1.5, 0];
        yield 'gets default priority on integer string' => [1, 0];
        yield 'gets default priority on empty string' => ['', 0];
        yield 'gets default priority on null' => [null, 0];
    }

    public static function hasHighestPriorityExamples(): Generator
    {
        yield 'checks if exponentiation enum has highest priority' => [MathematicalOperators::Exponentiation, true];
        yield 'checks if exponentiation string has highest priority' => [MathematicalOperators::Exponentiation->value, true];

        yield 'checks if multiplication enum does not have highest priority' => [MathematicalOperators::Multiplication, false];
        yield 'checks if multiplication string does not have highest priority' => [MathematicalOperators::Multiplication->value, false];

        yield 'checks if addition enum does not have highest priority' => [MathematicalOperators::Addition, false];
        yield 'checks if addition string does not have highest priority' => [MathematicalOperators::Addition->value, false];

        yield 'checks if null does not have highest priority' => [null, false];
    }

    public static function hasLowestPriorityExamples(): Generator
    {
        yield 'checks if null has highest priority' => [null, true];

        yield 'checks if addition enum does not have lowest priority' => [MathematicalOperators::Addition, false];
        yield 'checks if addition string does not have lowest priority' => [MathematicalOperators::Addition->value, false];

        yield 'checks if multiplication enum does not have lowest priority' => [MathematicalOperators::Multiplication, false];
        yield 'checks if multiplication string does not have lowest priority' => [MathematicalOperators::Multiplication->value, false];

        yield 'checks if exponentiation enum does not have lowest priority' => [MathematicalOperators::Exponentiation, false];
        yield 'checks if exponentiation string does not have lowest priority' => [MathematicalOperators::Exponentiation->value, false];
    }
}
