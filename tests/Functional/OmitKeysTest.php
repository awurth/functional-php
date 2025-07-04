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
use stdclass;

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

    /**
     * @dataProvider getData
     */
    public function test(array $expected, array $input, array $keys): void
    {
        self::assertSame($expected, omit_keys($input, $keys));
        self::assertSame($expected, omit_keys(new ArrayIterator($input), $keys));
    }

    public function testPassNonArrayOrTraversable(): void
    {
        $this->expectArgumentError('Functional\\omit_keys() expects parameter 1 to be array or instance of Traversable');
        omit_keys(new stdclass(), []);
    }
}
