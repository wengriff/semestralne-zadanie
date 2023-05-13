<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\TestFixture;

use PHPUnit\Framework\TestCase;

final class DuplicateKeyDataProviderTest extends TestCase
{
    public static function dataProvider()
    {
        yield 'foo' => ['foo'];

        yield 'foo' => ['bar'];
    }

    /**
     * @dataProvider dataProvider
     */
    public function test($arg): void
    {
    }
}
