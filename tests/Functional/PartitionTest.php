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

use function Functional\partition;
use function is_int;

final class PartitionTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->list = ['value1', 'value2', 'value3'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = ['k1' => 'val1', 'k2' => 'val2', 'k3' => 'val3'];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    public function test(): void
    {
        $fn = (static fn ($v, $k, iterable $collection) => is_int($k) ? ($k % 2 == 0) : ($v[3] % 2 == 0));
        self::assertSame([[0 => 'value1', 2 => 'value3'], [1 => 'value2']], partition($this->list, $fn));
        self::assertSame([[0 => 'value1', 2 => 'value3'], [1 => 'value2']], partition($this->listIterator, $fn));
        self::assertSame([['k2' => 'val2'], ['k1' => 'val1', 'k3' => 'val3']], partition($this->hash, $fn));
        self::assertSame([['k2' => 'val2'], ['k1' => 'val1', 'k3' => 'val3']], partition($this->hashIterator, $fn));
    }

    public function testMultiFn(): void
    {
        $fn1 = (static fn ($v, $k, iterable $collection) => is_int($k) ? (1 === $k) : ('2' === $v[3]));

        $fn2 = (static fn ($v, $k, iterable $collection) => is_int($k) ? (2 === $k) : ('3' === $v[3]));

        self::assertSame([[1 => 'value2'], [2 => 'value3'], [0 => 'value1']], partition($this->list, $fn1, $fn2));
        self::assertSame([[1 => 'value2'], [2 => 'value3'], [0 => 'value1']], partition($this->listIterator, $fn1, $fn2));
        self::assertSame([['k2' => 'val2'], ['k3' => 'val3'], ['k1' => 'val1']], partition($this->hash, $fn1, $fn2));
        self::assertSame([['k2' => 'val2'], ['k3' => 'val3'], ['k1' => 'val1']], partition($this->hashIterator, $fn1, $fn2));
    }

    public function testExceptionIsThrownInArray(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        partition($this->list, $this->exception(...));
    }

    public function testExceptionIsThrownInHash(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        partition($this->hash, $this->exception(...));
    }

    public function testExceptionIsThrownInIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        partition($this->listIterator, $this->exception(...));
    }

    public function testExceptionIsThrownInHashIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        partition($this->hashIterator, $this->exception(...));
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\partition', 2);
        partition($this->list, 'undefinedFunction');
    }
}
