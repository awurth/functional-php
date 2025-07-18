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

use function Functional\reject;

class RejectTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->list = ['value', 'wrong', 'value'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = ['k1' => 'value', 'k2' => 'wrong', 'k3' => 'value'];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    public function test(): void
    {
        $fn = (static fn ($v, $k, iterable $collection) => 'wrong' === $v && '' !== $k);
        self::assertSame([0 => 'value', 2 => 'value'], reject($this->list, $fn));
        self::assertSame([0 => 'value', 2 => 'value'], reject($this->listIterator, $fn));
        self::assertSame(['k1' => 'value', 'k3' => 'value'], reject($this->hash, $fn));
        self::assertSame(['k1' => 'value', 'k3' => 'value'], reject($this->hashIterator, $fn));
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\reject', 2);
        reject($this->list, 'undefinedFunction');
    }

    public function testPassNoCallable(): void
    {
        self::assertSame([], reject($this->list));
        self::assertSame([], reject($this->listIterator));
        self::assertSame([], reject($this->hash));
        self::assertSame([], reject($this->hashIterator));
        self::assertSame([1 => false], reject([true, false, true]));
    }

    public function testExceptionIsThrownInArray(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        reject($this->list, $this->exception(...));
    }

    public function testExceptionIsThrownInHash(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        reject($this->hash, $this->exception(...));
    }

    public function testExceptionIsThrownInIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        reject($this->listIterator, $this->exception(...));
    }

    public function testExceptionIsThrownInHashIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        reject($this->hashIterator, $this->exception(...));
    }
}
