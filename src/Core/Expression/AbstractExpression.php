<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Core\Expression;

use BackedEnum;
use Filczek\PhpPolishNotation\Core\Converters\Factory\ExpressionConverterFactory;
use Filczek\PhpPolishNotation\Core\Expression\Classifier\ClassifiesExpression;
use Filczek\PhpPolishNotation\Core\Expression\Stringifier\StringifiesExpression;

abstract readonly class AbstractExpression implements Expression, ConvertsExpression
{
    protected function __construct(
        protected array $elements,
        protected ExpressionConverterFactory $converter_factory,
        protected ClassifiesExpression $classify,
        protected StringifiesExpression $stringify,
    ) {
    }

    public function notation(): BackedEnum
    {
        return $this->classify->notationOf($this->toArray());
    }

    protected function convertTo(BackedEnum $to): static
    {
        $elements = $this->converter_factory
            ->createConverter(from: $this->notation(), to: $to)
            ->convert($this->toArray());

        return new static(
            elements: $elements,
            converter_factory: $this->converter_factory,
            classify: $this->classify,
            stringify: $this->stringify,
        );
    }

    public function toInfix(): static
    {
        return $this->convertTo(ExpressionNotation::Infix);
    }

    public function toPrefix(): static
    {
        return $this->convertTo(ExpressionNotation::Prefix);
    }

    public function toPostfix(): static
    {
        return $this->convertTo(ExpressionNotation::Postfix);
    }

    public function toString(): string
    {
        return (string) $this;
    }

    public function __toString(): string
    {
        return $this->stringify->stringify($this->toArray());
    }

    public function toArray(): array
    {
        return $this->elements;
    }
}
