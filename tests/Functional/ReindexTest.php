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

use function Functional\reindex;

class ReindexTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->list = ['value', 'value'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = ['k1' => 'val1', 'k2' => 'val2'];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    public function test(): void
    {
        $fn = (static fn ($v, $k, iterable $collection) => $k.$v);
        self::assertSame(['0value' => 'value', '1value' => 'value'], reindex($this->list, $fn));
        self::assertSame(['0value' => 'value', '1value' => 'value'], reindex($this->listIterator, $fn));
        self::assertSame(['k1val1' => 'val1', 'k2val2' => 'val2'], reindex($this->hash, $fn));
        self::assertSame(['k1val1' => 'val1', 'k2val2' => 'val2'], reindex($this->hashIterator, $fn));
    }

    public function testDuplicateKeys(): void
    {
        $fn = (static fn ($v, $k, iterable $collection) => $k[0]);
        self::assertSame(['k' => 'val2'], reindex($this->hash, $fn));
    }

    public function testExceptionIsThrownInArray(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        reindex($this->list, $this->exception(...));
    }

    public function testExceptionIsThrownInHash(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        reindex($this->hash, $this->exception(...));
    }

    public function testExceptionIsThrownInIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        reindex($this->listIterator, $this->exception(...));
    }

    public function testExceptionIsThrownInHashIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        reindex($this->hashIterator, $this->exception(...));
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\reindex', 2);
        reindex($this->list, 'undefinedFunction');
    }
}
