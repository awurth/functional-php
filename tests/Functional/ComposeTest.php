<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use function array_map;
use function Functional\compose;
use function range;

class ComposeTest extends AbstractTestCase
{
    public function test(): void
    {
        $input = range(0, 10);

        $plus2 = (static fn($x) => $x + 2);
        $times4 = (static fn($x) => $x * 4);
        $square = (static fn($x) => $x * $x);

        $composed = compose($plus2, $times4, $square);

        $composed_values = array_map(
            static fn($x) => $composed($x),
            $input,
        );

        $manual_values = array_map(
            static fn($x) => $square($times4($plus2($x))),
            $input,
        );

        self::assertEquals($composed_values, $manual_values);
    }

    public function testPassNoFunctions(): void
    {
        $input = range(0, 10);

        $composed = compose();

        $composed_values = array_map(
            static fn($x) => $composed($x),
            $input,
        );

        self::assertEquals($composed_values, $input);
    }
}
