<?php

/**
 * @author    Hugo Sales <hugo@fc.up.pt>
 * @copyright 2020 Hugo Sales
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use Functional\Exceptions\InvalidArgumentException;

use function Functional\ary;

class AryTest extends AbstractTestCase
{
    public function test(): void
    {
        $f = (static fn ($a = 0, $b = 0, $c = 0) => $a + $b + $c);

        self::assertSame(5, $f(5));
        self::assertSame(5, ary($f, 1)(5));
        self::assertSame(5, ary($f, 1)(5));
        self::assertSame(6, ary($f, -1)(6));
        self::assertSame(7, ary($f, 2)(5, 2));
    }

    public function testException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $f = (static fn ($a = 0, $b = 0, $c = 0) => $a + $b + $c);

        ary($f, 0)(5);
    }
}
