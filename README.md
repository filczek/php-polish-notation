# PHP Polish Notation

- 🤖 **Overengineered**: Built with extensibility in mind, supporting custom behavior while ensuring flexibility.
- 🌀 **Abstract Implementation**: Based on well-established abstract classes and interfaces to ensure ease of customization and separation of concerns.
- ✨ **Custom Expression Support**: Easily define your own expression types and structures.
- ⚖️ **Custom Operator Priority Support**: Fine-tune operator precedence for specialized use cases.
- 🧩 **Custom Expression Classifier Support**: Define your own rules for classifying expressions.
- 🔄 **Custom Converter Support**: Convert expressions to different notations with your custom logic.
- 🖋️ **Custom Notation Support**: Implement and use custom notation formats.
- 📚 **Fully Typed API**: Fully typed and documented API to ensure reliability and ease of use.

PHP Polish Notation is package designed to convert and validate [Polish notation (NPN, PN)](https://en.wikipedia.org/wiki/Polish_notation) and [Reverse Polish notation (RPN)](https://en.wikipedia.org/wiki/Reverse_Polish_notation), also known as **Prefix** and **Postfix** notation. It provides a flexible and extensible solution for working with mathematical and custom expressions, while ensuring high-quality, maintainable code by following modern design principles.

### Getting Started

#### Mathematical Expression

To convert and validate standard mathematical expressions, you can use the `MathematicalExpression` class. The package supports parsing and converting between different notations such as Infix, Prefix, and Postfix.

```php
$expression = MathematicalExpression::fromString("A + (B * C)");
$expression->notation(); // ExpressionNotation::Infix

$expression->withParentheses()->toInfix()->toString();      // 'A + (B * C)'
$expression->withParentheses()->toPrefix()->toString();     // '+ A (* B C)'
$expression->withParentheses()->toPostfix()->toString();    // 'A (B C *) +'

$expression->withoutParentheses()->toInfix()->toString();   // 'A + B * C'
$expression->withoutParentheses()->toPrefix()->toString();  // '+ A * B C'
$expression->withoutParentheses()->toPostfix()->toString(); // 'A B C * +'
```

#### Custom Expression

The package allows you to extend its functionality to support custom expressions. Below is an example of how to create a custom expression, define a custom tokenizer, converter factory, classifier, and stringifier.

```php
use Filczek\PhpPolishNotation\Core\Expression\AbstractExpression;
use Filczek\PhpPolishNotation\Core\Expression\Classifier\DefaultExpressionClassifier;
use Filczek\PhpPolishNotation\Core\Expression\Stringifier\WithoutParenthesesExpressionStringifier;

final readonly class ImapExpression extends AbstractExpression
{
    // 'fromString' is custom method, it is not required
    public static function fromString(string $expression): self
    {
        // Custom Tokenizer - returns array of 'ExpressionElement' class
        $elements = (new ImapExpressionTokenizer())->parse($expression);
        // Custom Converter Factory - e.g. from Infix to Prefix, you can use built-in 'DefaultExpressionConverterFactory'
        $converter_factory = new ImapExpressionConverterFactory();
        // ExpressionNotation::Infix, ExpressionNotation::Prefix, ExpressionNotation::Postfix
        $classifier = new DefaultExpressionClassifier();
        // Built-in Expression Stringifier
        $stringifier = new WithoutParenthesesExpressionStringifier();

        return new self(
            elements: $elements,
            converter_factory: $converter_factory,
            classify: $classifier,
            stringify: $stringifier,
        );
    }

    // custom method
    public static function fromArray(array $array): self
    {
        // ...
    }
}

$expression = ImapExpression::fromString("(SUBJECT subject OR BODY body) AND FROM from");
$expression->notation(); // ExpressionNotation::Infix
$expression->toPrefix()->toString(); // 'OR SUBJECT subject BODY body FROM from'
```

## License

This package is licensed under the [MIT License](LICENSE). 
