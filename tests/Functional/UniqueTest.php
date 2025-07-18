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

use function Functional\unique;

final class UniqueTest extends AbstractTestCase
{
    private array $mixedTypesArray;

    private ArrayIterator $mixedTypesIterator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->list = ['value1', 'value2', 'value1', 'value'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->mixedTypesArray = [1, '1', '2', 2, '3', 4];
        $this->mixedTypesIterator = new ArrayIterator($this->mixedTypesArray);
        $this->hash = ['k1' => 'val1', 'k2' => 'val2', 'k3' => 'val2'];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    public function testDefaultBehavior(): void
    {
        self::assertSame([0 => 'value1', 1 => 'value2', 3 => 'value'], unique($this->list));
        self::assertSame([0 => 'value1', 1 => 'value2', 3 => 'value'], unique($this->listIterator));
        self::assertSame(['k1' => 'val1', 'k2' => 'val2'], unique($this->hash));
        self::assertSame(['k1' => 'val1', 'k2' => 'val2'], unique($this->hashIterator));
        $fn = (static fn ($value, $key, $collection) => $value);
        self::assertSame([0 => 'value1', 1 => 'value2', 3 => 'value'], unique($this->list, $fn));
        self::assertSame([0 => 'value1', 1 => 'value2', 3 => 'value'], unique($this->listIterator, $fn));
        self::assertSame(['k1' => 'val1', 'k2' => 'val2'], unique($this->hash, $fn));
        self::assertSame(['k1' => 'val1', 'k2' => 'val2'], unique($this->hashIterator, $fn));
    }

    public function testUnifyingByClosure(): void
    {
        $fn = (static fn ($value, $key, $collection) => 0 === $key ? 'zero' : 'else');
        self::assertSame([0 => 'value1', 1 => 'value2'], unique($this->list, $fn));
        self::assertSame([0 => 'value1', 1 => 'value2'], unique($this->listIterator, $fn));
        $fn = (static fn ($value, $key, $collection) => 0);
        self::assertSame(['k1' => 'val1'], unique($this->hash, $fn));
        self::assertSame(['k1' => 'val1'], unique($this->hashIterator, $fn));
    }

    public function testUnifyingStrict(): void
    {
        self::assertSame([1, '1', '2', 2, '3', 4], unique($this->mixedTypesArray));
        self::assertSame([1, '1', '2', 2, '3', 4], unique($this->mixedTypesIterator));

        $fn = (static fn ($value, $key, $collection) => $value);

        self::assertSame([1, '1', '2', 2, '3', 4], unique($this->mixedTypesArray, $fn));
        self::assertSame([1, '1', '2', 2, '3', 4], unique($this->mixedTypesIterator, $fn));
    }

    public function testPassingNullAsCallback(): void
    {
        self::assertSame([0 => 'value1', 1 => 'value2', 3 => 'value'], unique($this->list));
        self::assertSame([0 => 'value1', 1 => 'value2', 3 => 'value'], unique($this->list, null));
    }

    public function testExceptionIsThrownInArray(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        unique($this->list, $this->exception(...));
    }

    public function testExceptionIsThrownInHash(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        unique($this->hash, $this->exception(...));
    }

    public function testExceptionIsThrownInIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        unique($this->listIterator, $this->exception(...));
    }

    public function testExceptionIsThrownInHashIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        unique($this->hashIterator, $this->exception(...));
    }

    public function testPassNonCallableUndefinedFunction(): void
    {
        $this->expectCallableArgumentError('Functional\unique', 2);
        unique($this->list, 'undefinedFunction');
    }
}
