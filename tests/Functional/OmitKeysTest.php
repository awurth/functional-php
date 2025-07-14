<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use ArrayIterator;
use PHPUnit\Framework\Attributes\DataProvider;

use function Functional\omit_keys;

class OmitKeysTest extends AbstractTestCase
{
    public static function getData(): array
    {
        return [
            [['foo' => 1], ['foo' => 1], []],
            [['foo' => 1], ['foo' => 1], ['bar']],
            [[], ['foo' => 1], ['foo']],
            [[], ['foo' => 1, 'bar' => 2], ['foo', 'bar']],
            [['bar' => 2], ['foo' => 1, 'bar' => 2], ['foo']],
            [[1 => 'b'], ['a', 'b', 'c'], [0, 2]],
        ];
    }

    #[DataProvider('getData')]
    public function test(array $expected, array $input, array $keys): void
    {
        self::assertSame($expected, omit_keys($input, $keys));
        self::assertSame($expected, omit_keys(new ArrayIterator($input), $keys));
    }
}
