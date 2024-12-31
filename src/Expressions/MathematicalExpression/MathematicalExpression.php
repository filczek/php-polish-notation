<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation\Expressions\MathematicalExpression;

use Filczek\PhpPolishNotation\Core\Expression\AbstractExpression;
use Filczek\PhpPolishNotation\Core\Expression\Classifier\DefaultExpressionClassifier;
use Filczek\PhpPolishNotation\Core\Expression\Stringifier\WithoutParenthesesExpressionStringifier;
use Filczek\PhpPolishNotation\Core\Expression\Stringifier\WithParenthesesExpressionStringifier;
use Filczek\PhpPolishNotation\Expressions\MathematicalExpression\Tokenizer\MathematicalExpressionTokenizer;

final readonly class MathematicalExpression extends AbstractExpression
{
    public static function fromString(string $expression): self
    {
        $elements = (new MathematicalExpressionTokenizer())->parse($expression);
        $converter_factory = new MathematicalExpressionConverterFactory();
        $classifier = new DefaultExpressionClassifier();
        $stringifier = new WithParenthesesExpressionStringifier();

        return new self(
            elements: $elements,
            converter_factory: $converter_factory,
            classify: $classifier,
            stringify: $stringifier,
        );
    }

    public function withParentheses(): self
    {
        return new self(
            elements: $this->elements,
            converter_factory: $this->converter_factory,
            classify: $this->classify,
            stringify: new WithParenthesesExpressionStringifier(),
        );
    }

    public function withoutParentheses(): self
    {
        return new self(
            elements: $this->elements,
            converter_factory: $this->converter_factory,
            classify: $this->classify,
            stringify: new WithoutParenthesesExpressionStringifier(),
        );
    }
}
