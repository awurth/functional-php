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

use function Functional\flat_map;

class FlatMapTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->list = ['a', ['b'], ['C' => 'c'], [['d']], null];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = ['ka' => 'a', 'kb' => ['b'], 'kc' => ['C' => 'c'], 'kd' => [['d']], 'ke' => null, null];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    public function testList(): void
    {
        $flat = flat_map(
            ['a', ['b'], ['C' => 'c'], [['d']], null],
            static fn ($v, $k, iterable $collection) => $v,
        );

        self::assertSame(['a', 'b', 'c', ['d']], $flat);
    }

    public function testListIterator(): void
    {
        $flat = flat_map(
            new ArrayIterator(['a', ['b'], ['C' => 'c'], [['d']], null]),
            static fn ($v, $k, iterable $collection) => $v,
        );

        self::assertSame(['a', 'b', 'c', ['d']], $flat);
    }

    public function testHash(): void
    {
        $flat = flat_map(
            ['ka' => 'a', 'kb' => ['b'], 'kc' => ['C' => 'c'], 'kd' => [['d']], 'ke' => null, null],
            static fn ($v, $k, iterable $collection) => $v,
        );

        self::assertSame(['a', 'b', 'c', ['d']], $flat);
    }

    public function testHashIterator(): void
    {
        $flat = flat_map(
            new ArrayIterator(['ka' => 'a', 'kb' => ['b'], 'kc' => ['C' => 'c'], 'kd' => [['d']], 'ke' => null, null]),
            static fn ($v, $k, iterable $collection) => $v,
        );

        self::assertSame(['a', 'b', 'c', ['d']], $flat);
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\flat_map', 2);
        flat_map($this->list, 'undefinedFunction');
    }
}
