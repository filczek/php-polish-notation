<?php

declare(strict_types=1);

namespace Filczek\PhpPolishNotation;

use Filczek\PhpPolishNotation\Core\Expression\ExpressionElement;
use Filczek\PhpPolishNotation\Core\Expression\ExpressionElementType;

final readonly class MathNotationDataProvider
{
    public static function data(): array
    {
        return [
            [
                'infix' => [
                    'string_expression' => 'A + (B * C)',
                    'string_expression_without_parentheses' => 'A + B * C',
                    'array_expression' => [
                        new ExpressionElement("A", ExpressionElementType::Operand),
                        new ExpressionElement("+", ExpressionElementType::Operator),
                        [
                            new ExpressionElement("B", ExpressionElementType::Operand),
                            new ExpressionElement("*", ExpressionElementType::Operator),
                            new ExpressionElement("C", ExpressionElementType::Operand),
                        ],
                    ],
                ],
                'prefix' => [
                    'string_expression' => '+ A (* B C)',
                    'string_expression_without_parentheses' => '+ A * B C',
                    'array_expression' => [
                        new ExpressionElement("+", ExpressionElementType::Operator),
                        new ExpressionElement("A", ExpressionElementType::Operand),
                        [
                            new ExpressionElement("*", ExpressionElementType::Operator),
                            new ExpressionElement("B", ExpressionElementType::Operand),
                            new ExpressionElement("C", ExpressionElementType::Operand),
                        ],
                    ],
                ],
                'postfix' => [
                    'string_expression' => 'A (B C *) +',
                    'string_expression_without_parentheses' => 'A B C * +',
                    'array_expression' => [
                        new ExpressionElement("A", ExpressionElementType::Operand),
                        [
                            new ExpressionElement("B", ExpressionElementType::Operand),
                            new ExpressionElement("C", ExpressionElementType::Operand),
                            new ExpressionElement("*", ExpressionElementType::Operator),
                        ],
                        new ExpressionElement("+", ExpressionElementType::Operator),
                    ],
                ],
            ],
            [
                'infix' => [
                    'string_expression' => '(A * B) + (C / D)',
                    'string_expression_without_parentheses' => 'A * B + C / D',
                    'array_expression' => [
                        [
                            new ExpressionElement("A", ExpressionElementType::Operand),
                            new ExpressionElement("*", ExpressionElementType::Operator),
                            new ExpressionElement("B", ExpressionElementType::Operand),
                        ],
                        new ExpressionElement("+", ExpressionElementType::Operator),
                        [
                            new ExpressionElement("C", ExpressionElementType::Operand),
                            new ExpressionElement("/", ExpressionElementType::Operator),
                            new ExpressionElement("D", ExpressionElementType::Operand),
                        ],
                    ],
                ],
                'prefix' => [
                    'string_expression' => '+ (* A B) (/ C D)',
                    'string_expression_without_parentheses' => '+ * A B / C D',
                    'array_expression' => [
                        new ExpressionElement("+", ExpressionElementType::Operator),
                        [
                            new ExpressionElement("*", ExpressionElementType::Operator),
                            new ExpressionElement("A", ExpressionElementType::Operand),
                            new ExpressionElement("B", ExpressionElementType::Operand),
                        ],
                        [
                            new ExpressionElement("/", ExpressionElementType::Operator),
                            new ExpressionElement("C", ExpressionElementType::Operand),
                            new ExpressionElement("D", ExpressionElementType::Operand),
                        ],
                    ],
                ],
                'postfix' => [
                    'string_expression' => '(A B *) (C D /) +',
                    'string_expression_without_parentheses' => 'A B * C D / +',
                    'array_expression' => [
                        [
                            new ExpressionElement("A", ExpressionElementType::Operand),
                            new ExpressionElement("B", ExpressionElementType::Operand),
                            new ExpressionElement("*", ExpressionElementType::Operator),
                        ],
                        [
                            new ExpressionElement("C", ExpressionElementType::Operand),
                            new ExpressionElement("D", ExpressionElementType::Operand),
                            new ExpressionElement("/", ExpressionElementType::Operator),
                        ],
                        new ExpressionElement("+", ExpressionElementType::Operator),
                    ],
                ],
            ],
            [
                'infix' => [
                    'string_expression' => '(A - (B / C)) * ((A / K) - L)',
                    'string_expression_without_parentheses' => 'A - B / C * A / K - L',
                    'array_expression' => [
                        [
                            new ExpressionElement("A", ExpressionElementType::Operand),
                            new ExpressionElement("-", ExpressionElementType::Operator),
                            [
                                new ExpressionElement("B", ExpressionElementType::Operand),
                                new ExpressionElement("/", ExpressionElementType::Operator),
                                new ExpressionElement("C", ExpressionElementType::Operand),
                            ],
                        ],
                        new ExpressionElement("*", ExpressionElementType::Operator),
                        [
                            [
                                new ExpressionElement("A", ExpressionElementType::Operand),
                                new ExpressionElement("/", ExpressionElementType::Operator),
                                new ExpressionElement("K", ExpressionElementType::Operand),
                            ],
                            new ExpressionElement("-", ExpressionElementType::Operator),
                            new ExpressionElement("L", ExpressionElementType::Operand),
                        ],
                    ],
                ],
                'prefix' => [
                    'string_expression' => '* (- A (/ B C)) (- (/ A K) L)',
                    'string_expression_without_parentheses' => '* - A / B C - / A K L',
                    'array_expression' => [
                        new ExpressionElement("*", ExpressionElementType::Operator),
                        [
                            new ExpressionElement("-", ExpressionElementType::Operator),
                            new ExpressionElement("A", ExpressionElementType::Operand),
                            [
                                new ExpressionElement("/", ExpressionElementType::Operator),
                                new ExpressionElement("B", ExpressionElementType::Operand),
                                new ExpressionElement("C", ExpressionElementType::Operand),
                            ],
                        ],
                        [
                            new ExpressionElement("-", ExpressionElementType::Operator),
                            [
                                new ExpressionElement("/", ExpressionElementType::Operator),
                                new ExpressionElement("A", ExpressionElementType::Operand),
                                new ExpressionElement("K", ExpressionElementType::Operand),
                            ],
                            new ExpressionElement("L", ExpressionElementType::Operand),
                        ],
                    ],
                ],
                'postfix' => [
                    'string_expression' => '(A (B C /) -) ((A K /) L -) *',
                    'string_expression_without_parentheses' => 'A B C / - A K / L - *',
                    'array_expression' => [
                        [
                            new ExpressionElement("A", ExpressionElementType::Operand),
                            [
                                new ExpressionElement("B", ExpressionElementType::Operand),
                                new ExpressionElement("C", ExpressionElementType::Operand),
                                new ExpressionElement("/", ExpressionElementType::Operator),
                            ],
                            new ExpressionElement("-", ExpressionElementType::Operator),
                        ],
                        [
                            [
                                new ExpressionElement("A", ExpressionElementType::Operand),
                                new ExpressionElement("K", ExpressionElementType::Operand),
                                new ExpressionElement("/", ExpressionElementType::Operator),
                            ],
                            new ExpressionElement("L", ExpressionElementType::Operand),
                            new ExpressionElement("-", ExpressionElementType::Operator),
                        ],
                        new ExpressionElement("*", ExpressionElementType::Operator),
                    ],
                ],
            ],
            [
                'infix' => [
                    'string_expression' => '(x + ((y * z) / w)) + u',
                    'string_expression_without_parentheses' => 'x + y * z / w + u',
                    'array_expression' => [
                        [
                            new ExpressionElement("x", ExpressionElementType::Operand),
                            new ExpressionElement("+", ExpressionElementType::Operator),
                            [
                                [
                                    new ExpressionElement("y", ExpressionElementType::Operand),
                                    new ExpressionElement("*", ExpressionElementType::Operator),
                                    new ExpressionElement("z", ExpressionElementType::Operand),
                                ],
                                new ExpressionElement("/", ExpressionElementType::Operator),
                                new ExpressionElement("w", ExpressionElementType::Operand),
                            ],
                        ],
                        new ExpressionElement("+", ExpressionElementType::Operator),
                        new ExpressionElement("u", ExpressionElementType::Operand),
                    ],
                ],
                'prefix' => [
                    'string_expression' => '+ (+ x (/ (* y z) w)) u',
                    'string_expression_without_parentheses' => '+ + x / * y z w u',
                    'array_expression' => [
                        new ExpressionElement("+", ExpressionElementType::Operator),
                        [
                            new ExpressionElement("+", ExpressionElementType::Operator),
                            new ExpressionElement("x", ExpressionElementType::Operand),
                            [
                                new ExpressionElement("/", ExpressionElementType::Operator),
                                [
                                    new ExpressionElement("*", ExpressionElementType::Operator),
                                    new ExpressionElement("y", ExpressionElementType::Operand),
                                    new ExpressionElement("z", ExpressionElementType::Operand),
                                ],
                                new ExpressionElement("w", ExpressionElementType::Operand),
                            ],
                        ],
                        new ExpressionElement("u", ExpressionElementType::Operand),

                    ],
                ],
                'postfix' => [
                    'string_expression' => '(x ((y z *) w /) +) u +',
                    'string_expression_without_parentheses' => 'x y z * w / + u +',
                    'array_expression' => [
                        [
                            new ExpressionElement("x", ExpressionElementType::Operand),
                            [
                                [
                                    new ExpressionElement("y", ExpressionElementType::Operand),
                                    new ExpressionElement("z", ExpressionElementType::Operand),
                                    new ExpressionElement("*", ExpressionElementType::Operator),
                                ],
                                new ExpressionElement("w", ExpressionElementType::Operand),
                                new ExpressionElement("/", ExpressionElementType::Operator),
                            ],
                            new ExpressionElement("+", ExpressionElementType::Operator),
                        ],
                        new ExpressionElement("u", ExpressionElementType::Operand),
                        new ExpressionElement("+", ExpressionElementType::Operator),
                    ],
                ],
            ],
            [
                'infix' => [
                    'string_expression' => '((x ^ y) / (5 * z)) + 2',
                    'string_expression_without_parentheses' => 'x ^ y / 5 * z + 2',
                    'array_expression' => [
                        [
                            [
                                new ExpressionElement("x", ExpressionElementType::Operand),
                                new ExpressionElement("^", ExpressionElementType::Operator),
                                new ExpressionElement("y", ExpressionElementType::Operand),
                            ],
                            new ExpressionElement("/", ExpressionElementType::Operator),
                            [
                                new ExpressionElement("5", ExpressionElementType::Operand),
                                new ExpressionElement("*", ExpressionElementType::Operator),
                                new ExpressionElement("z", ExpressionElementType::Operand),
                            ],
                        ],
                        new ExpressionElement("+", ExpressionElementType::Operator),
                        new ExpressionElement("2", ExpressionElementType::Operand),
                    ],
                ],
                'prefix' => [
                    'string_expression' => '+ (/ (^ x y) (* 5 z)) 2',
                    'string_expression_without_parentheses' => '+ / ^ x y * 5 z 2',
                    'array_expression' => [
                        new ExpressionElement("+", ExpressionElementType::Operator),
                        [
                            new ExpressionElement("/", ExpressionElementType::Operator),
                            [
                                new ExpressionElement("^", ExpressionElementType::Operator),
                                new ExpressionElement("x", ExpressionElementType::Operand),
                                new ExpressionElement("y", ExpressionElementType::Operand),
                            ],
                            [
                                new ExpressionElement("*", ExpressionElementType::Operator),
                                new ExpressionElement("5", ExpressionElementType::Operand),
                                new ExpressionElement("z", ExpressionElementType::Operand),
                            ],
                        ],
                        new ExpressionElement("2", ExpressionElementType::Operand),
                    ],
                ],
                'postfix' => [
                    'string_expression' => '((x y ^) (5 z *) /) 2 +',
                    'string_expression_without_parentheses' => 'x y ^ 5 z * / 2 +',
                    'array_expression' => [
                        [
                            [
                                new ExpressionElement("x", ExpressionElementType::Operand),
                                new ExpressionElement("y", ExpressionElementType::Operand),
                                new ExpressionElement("^", ExpressionElementType::Operator),
                            ],
                            [
                                new ExpressionElement("5", ExpressionElementType::Operand),
                                new ExpressionElement("z", ExpressionElementType::Operand),
                                new ExpressionElement("*", ExpressionElementType::Operator),
                            ],
                            new ExpressionElement("/", ExpressionElementType::Operator),
                        ],
                        new ExpressionElement("2", ExpressionElementType::Operand),
                        new ExpressionElement("+", ExpressionElementType::Operator),
                    ],
                ],
            ],
            [
                'infix' => [
                    'string_expression' => 'a * ((b + c) + d)',
                    'string_expression_without_parentheses' => 'a * b + c + d',
                    'array_expression' => [
                        new ExpressionElement("a", ExpressionElementType::Operand),
                        new ExpressionElement("*", ExpressionElementType::Operator),
                        [
                            [
                                new ExpressionElement("b", ExpressionElementType::Operand),
                                new ExpressionElement("+", ExpressionElementType::Operator),
                                new ExpressionElement("c", ExpressionElementType::Operand),
                            ],
                            new ExpressionElement("+", ExpressionElementType::Operator),
                            new ExpressionElement("d", ExpressionElementType::Operand),
                        ],
                    ],
                ],
                'prefix' => [
                    'string_expression' => '* a (+ (+ b c) d)',
                    'string_expression_without_parentheses' => '* a + + b c d',
                    'array_expression' => [
                        new ExpressionElement("*", ExpressionElementType::Operator),
                        new ExpressionElement("a", ExpressionElementType::Operand),
                        [
                            new ExpressionElement("+", ExpressionElementType::Operator),
                            [
                                new ExpressionElement("+", ExpressionElementType::Operator),
                                new ExpressionElement("b", ExpressionElementType::Operand),
                                new ExpressionElement("c", ExpressionElementType::Operand),
                            ],
                            new ExpressionElement("d", ExpressionElementType::Operand),
                        ],
                    ],
                ],
                'postfix' => [
                    'string_expression' => 'a ((b c +) d +) *',
                    'string_expression_without_parentheses' => 'a b c + d + *',
                    'array_expression' => [
                        new ExpressionElement("a", ExpressionElementType::Operand),
                        [
                            [
                                new ExpressionElement("b", ExpressionElementType::Operand),
                                new ExpressionElement("c", ExpressionElementType::Operand),
                                new ExpressionElement("+", ExpressionElementType::Operator),
                            ],
                            new ExpressionElement("d", ExpressionElementType::Operand),
                            new ExpressionElement("+", ExpressionElementType::Operator),
                        ],
                        new ExpressionElement("*", ExpressionElementType::Operator),
                    ],
                ],
            ],
            [
                'infix' => [
                    'string_expression' => '((ax + bc) + cx) + ((a + 1.5) + (2 * (3 + 4)))',
                    'string_expression_without_parentheses' => 'ax + bc + cx + a + 1.5 + 2 * 3 + 4',
                    'array_expression' => [
                        [
                            [
                                new ExpressionElement("ax", ExpressionElementType::Operand),
                                new ExpressionElement("+", ExpressionElementType::Operator),
                                new ExpressionElement("bc", ExpressionElementType::Operand),
                            ],
                            new ExpressionElement("+", ExpressionElementType::Operator),
                            new ExpressionElement("cx", ExpressionElementType::Operand),
                        ],
                        new ExpressionElement("+", ExpressionElementType::Operator),
                        [
                            [
                                new ExpressionElement("a", ExpressionElementType::Operand),
                                new ExpressionElement("+", ExpressionElementType::Operator),
                                new ExpressionElement("1.5", ExpressionElementType::Operand),
                            ],
                            new ExpressionElement("+", ExpressionElementType::Operator),
                            [
                                new ExpressionElement("2", ExpressionElementType::Operand),
                                new ExpressionElement("*", ExpressionElementType::Operator),
                                [
                                    new ExpressionElement("3", ExpressionElementType::Operand),
                                    new ExpressionElement("+", ExpressionElementType::Operator),
                                    new ExpressionElement("4", ExpressionElementType::Operand),
                                ],
                            ],
                        ],
                    ],
                ],
                'prefix' => [
                    'string_expression' => '+ (+ (+ ax bc) cx) (+ (+ a 1.5) (* 2 (+ 3 4)))',
                    'string_expression_without_parentheses' => '+ + + ax bc cx + + a 1.5 * 2 + 3 4',
                    'array_expression' => [
                        new ExpressionElement("+", ExpressionElementType::Operator),
                        [
                            new ExpressionElement("+", ExpressionElementType::Operator),
                            [
                                new ExpressionElement("+", ExpressionElementType::Operator),
                                new ExpressionElement("ax", ExpressionElementType::Operand),
                                new ExpressionElement("bc", ExpressionElementType::Operand),
                            ],
                            new ExpressionElement("cx", ExpressionElementType::Operand),
                        ],
                        [
                            new ExpressionElement("+", ExpressionElementType::Operator),
                            [
                                new ExpressionElement("+", ExpressionElementType::Operator),
                                new ExpressionElement("a", ExpressionElementType::Operand),
                                new ExpressionElement("1.5", ExpressionElementType::Operand),
                            ],
                            [
                                new ExpressionElement("*", ExpressionElementType::Operator),
                                new ExpressionElement("2", ExpressionElementType::Operand),
                                [
                                    new ExpressionElement("+", ExpressionElementType::Operator),
                                    new ExpressionElement("3", ExpressionElementType::Operand),
                                    new ExpressionElement("4", ExpressionElementType::Operand),
                                ],
                            ],
                        ],
                    ],
                ],
                'postfix' => [
                    'string_expression' => '((ax bc +) cx +) ((a 1.5 +) (2 (3 4 +) *) +) +',
                    'string_expression_without_parentheses' => 'ax bc + cx + a 1.5 + 2 3 4 + * + +',
                    'array_expression' => [
                        [
                            [
                                new ExpressionElement("ax", ExpressionElementType::Operand),
                                new ExpressionElement("bc", ExpressionElementType::Operand),
                                new ExpressionElement("+", ExpressionElementType::Operator),
                            ],
                            new ExpressionElement("cx", ExpressionElementType::Operand),
                            new ExpressionElement("+", ExpressionElementType::Operator),
                        ],
                        [
                            [
                                new ExpressionElement("a", ExpressionElementType::Operand),
                                new ExpressionElement("1.5", ExpressionElementType::Operand),
                                new ExpressionElement("+", ExpressionElementType::Operator),
                            ],
                            [
                                new ExpressionElement("2", ExpressionElementType::Operand),
                                [
                                    new ExpressionElement("3", ExpressionElementType::Operand),
                                    new ExpressionElement("4", ExpressionElementType::Operand),
                                    new ExpressionElement("+", ExpressionElementType::Operator),
                                ],
                                new ExpressionElement("*", ExpressionElementType::Operator),
                            ],
                            new ExpressionElement("+", ExpressionElementType::Operator),
                        ],
                        new ExpressionElement("+", ExpressionElementType::Operator),
                    ],
                ],
            ],
            [
                'infix' => [
                    'string_expression' => '(a + (b * (((c ^ d) - e) ^ (f + (g * h))))) - i',
                    'string_expression_without_parentheses' => 'a + b * c ^ d - e ^ f + g * h - i',
                    'array_expression' => [
                        [
                            new ExpressionElement("a", ExpressionElementType::Operand),
                            new ExpressionElement("+", ExpressionElementType::Operator),
                            [
                                new ExpressionElement("b", ExpressionElementType::Operand),
                                new ExpressionElement("*", ExpressionElementType::Operator),
                                [
                                    [
                                        [
                                            new ExpressionElement("c", ExpressionElementType::Operand),
                                            new ExpressionElement("^", ExpressionElementType::Operator),
                                            new ExpressionElement("d", ExpressionElementType::Operand),
                                        ],
                                        new ExpressionElement("-", ExpressionElementType::Operator),
                                        new ExpressionElement("e", ExpressionElementType::Operand),
                                    ],
                                    new ExpressionElement("^", ExpressionElementType::Operator),
                                    [
                                        new ExpressionElement("f", ExpressionElementType::Operand),
                                        new ExpressionElement("+", ExpressionElementType::Operator),
                                        [
                                            new ExpressionElement("g", ExpressionElementType::Operand),
                                            new ExpressionElement("*", ExpressionElementType::Operator),
                                            new ExpressionElement("h", ExpressionElementType::Operand),
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        new ExpressionElement("-", ExpressionElementType::Operator),
                        new ExpressionElement("i", ExpressionElementType::Operand),
                    ],
                ],
                'prefix' => [
                    'string_expression' => '- (+ a (* b (^ (- (^ c d) e) (+ f (* g h))))) i',
                    'string_expression_without_parentheses' => '- + a * b ^ - ^ c d e + f * g h i',
                    'array_expression' => [
                        new ExpressionElement("-", ExpressionElementType::Operator),
                        [
                            new ExpressionElement("+", ExpressionElementType::Operator),
                            new ExpressionElement("a", ExpressionElementType::Operand),
                            [
                                new ExpressionElement("*", ExpressionElementType::Operator),
                                new ExpressionElement("b", ExpressionElementType::Operand),
                                [
                                    new ExpressionElement("^", ExpressionElementType::Operator),
                                    [
                                        new ExpressionElement("-", ExpressionElementType::Operator),
                                        [
                                            new ExpressionElement("^", ExpressionElementType::Operator),
                                            new ExpressionElement("c", ExpressionElementType::Operand),
                                            new ExpressionElement("d", ExpressionElementType::Operand),
                                        ],
                                        new ExpressionElement("e", ExpressionElementType::Operand),
                                    ],
                                    [
                                        new ExpressionElement("+", ExpressionElementType::Operator),
                                        new ExpressionElement("f", ExpressionElementType::Operand),
                                        [
                                            new ExpressionElement("*", ExpressionElementType::Operator),
                                            new ExpressionElement("g", ExpressionElementType::Operand),
                                            new ExpressionElement("h", ExpressionElementType::Operand),
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        new ExpressionElement("i", ExpressionElementType::Operand),
                    ],
                ],
                'postfix' => [
                    'string_expression' => '(a (b (((c d ^) e -) (f (g h *) +) ^) *) +) i -',
                    'string_expression_without_parentheses' => 'a b c d ^ e - f g h * + ^ * + i -',
                    'array_expression' => [
                        [
                            new ExpressionElement("a", ExpressionElementType::Operand),
                            [
                                new ExpressionElement("b", ExpressionElementType::Operand),
                                [
                                    [
                                        [
                                            new ExpressionElement("c", ExpressionElementType::Operand),
                                            new ExpressionElement("d", ExpressionElementType::Operand),
                                            new ExpressionElement("^", ExpressionElementType::Operator),
                                        ],
                                        new ExpressionElement("e", ExpressionElementType::Operand),
                                        new ExpressionElement("-", ExpressionElementType::Operator),
                                    ],
                                    [
                                        new ExpressionElement("f", ExpressionElementType::Operand),
                                        [
                                            new ExpressionElement("g", ExpressionElementType::Operand),
                                            new ExpressionElement("h", ExpressionElementType::Operand),
                                            new ExpressionElement("*", ExpressionElementType::Operator),
                                        ],
                                        new ExpressionElement("+", ExpressionElementType::Operator),
                                    ],
                                    new ExpressionElement("^", ExpressionElementType::Operator),
                                ],
                                new ExpressionElement("*", ExpressionElementType::Operator),
                            ],
                            new ExpressionElement("+", ExpressionElementType::Operator),
                        ],
                        new ExpressionElement("i", ExpressionElementType::Operand),
                        new ExpressionElement("-", ExpressionElementType::Operator),
                    ],
                ],
            ],
        ];
    }
}
