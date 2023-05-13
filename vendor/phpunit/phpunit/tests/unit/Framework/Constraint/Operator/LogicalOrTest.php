<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Constraint;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

#[CoversClass(LogicalOr::class)]
#[CoversClass(BinaryOperator::class)]
#[CoversClass(Operator::class)]
#[CoversClass(Constraint::class)]
#[Small]
final class LogicalOrTest extends TestCase
{
    public static function provider(): array
    {
        return [
            [
                true,
                'is of type boolean or is true',
                '',
                self::logicalOr(
                    self::isType('boolean'),
                    self::isTrue(),
                ),
                true,
            ],

            [
                true,
                'is true or is of type boolean and is false',
                '',
                self::logicalOr(
                    self::isTrue(),
                    self::logicalAnd(
                        self::isType('boolean'),
                        self::isFalse()
                    ),
                ),
                true,
            ],

            [
                false,
                'is of type boolean or is of type string',
                'Failed asserting that 0 is of type boolean or is of type string.',
                self::logicalOr(
                    self::isType('boolean'),
                    self::isType('string'),
                ),
                0,
            ],
        ];
    }

    #[DataProvider('provider')]
    public function testCanBeEvaluated(bool $result, string $constraintAsString, string $failureDescription, LogicalOr $constraint, mixed $actual): void
    {
        $this->assertSame($result, $constraint->evaluate($actual, returnResult: true));

        if ($result) {
            return;
        }

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage($failureDescription);

        $constraint->evaluate($actual);
    }

    #[DataProvider('provider')]
    public function testCanBeRepresentedAsString(bool $result, string $constraintAsString, string $failureDescription, LogicalOr $constraint, mixed $actual): void
    {
        $this->assertSame($constraintAsString, $constraint->toString());
    }

    public function testIsCountable(): void
    {
        $constraint = $this->logicalOr(
            $this->isType('bool'),
            $this->isTrue()
        );

        $this->assertCount(2, $constraint);
    }
}
