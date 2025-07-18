<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use PHPUnit\Framework\TestCase;

use function Functional\tail_recursion;

class TailRecursionTest extends TestCase
{
    public function testTailRecursion1(): void
    {
        $fact = tail_recursion(static function ($n, $acc = 1) use (&$fact) {
            if (0 == $n) {
                return $acc;
            }

            return $fact($n - 1, $acc * $n);
        });
        self::assertEquals(3628800, $fact(10));
    }

    public function testTailRecursion2(): void
    {
        $sum_of_range = tail_recursion(static function ($from, $to, $acc = 0) use (&$sum_of_range) {
            if ($from > $to) {
                return $acc;
            }

            return $sum_of_range($from + 1, $to, $acc + $from);
        });

        self::assertEquals(50005000, $sum_of_range(1, 10000));
    }
}
