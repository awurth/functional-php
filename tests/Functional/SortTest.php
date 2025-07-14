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
use Closure;
use Functional as F;

use function strcmp;

final class SortTest extends AbstractTestCase
{
    private Closure $sortCallback;

    protected function setUp(): void
    {
        parent::setUp();
        $this->list = ['cat', 'bear', 'aardvark'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = ['c' => 'cat', 'b' => 'bear', 'a' => 'aardvark'];
        $this->hashIterator = new ArrayIterator($this->hash);
        $this->sortCallback = (static fn (string $left, string $right, iterable $collection) => strcmp($left, $right));
    }

    public function testPreserveKeys(): void
    {
        self::assertSame([2 => 'aardvark', 1 => 'bear', 0 => 'cat'], F\sort($this->list, $this->sortCallback, true));
        self::assertSame([2 => 'aardvark', 1 => 'bear', 0 => 'cat'], F\sort($this->listIterator, $this->sortCallback, true));
        self::assertSame(['a' => 'aardvark', 'b' => 'bear', 'c' => 'cat'], F\sort($this->hash, $this->sortCallback, true));
        self::assertSame(['a' => 'aardvark', 'b' => 'bear', 'c' => 'cat'], F\sort($this->hashIterator, $this->sortCallback, true));
    }

    public function testWithoutPreserveKeys(): void
    {
        self::assertSame([0 => 'aardvark', 1 => 'bear', 2 => 'cat'], F\sort($this->list, $this->sortCallback, false));
        self::assertSame([0 => 'aardvark', 1 => 'bear', 2 => 'cat'], F\sort($this->listIterator, $this->sortCallback, false));
        self::assertSame([0 => 'aardvark', 1 => 'bear', 2 => 'cat'], F\sort($this->hash, $this->sortCallback, false));
        self::assertSame([0 => 'aardvark', 1 => 'bear', 2 => 'cat'], F\sort($this->hashIterator, $this->sortCallback, false));
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\sort', 2);
        F\sort($this->list, 'undefinedFunction');
    }

    public function testExceptionIsThrownInArray(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        F\sort($this->list, $this->exception(...));
    }

    public function testExceptionIsThrownInHash(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        F\sort($this->hash, $this->exception(...));
    }

    public function testExceptionIsThrownInIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        F\sort($this->listIterator, $this->exception(...));
    }

    public function testExceptionIsThrownInHashIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        F\sort($this->hashIterator, $this->exception(...));
    }
}
