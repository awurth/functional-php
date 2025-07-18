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

use function Functional\drop_first;
use function Functional\drop_last;
use function is_int;

class DropTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->list = ['value1', 'value2', 'value3', 'value4'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = ['k1' => 'val1', 'k2' => 'val2', 'k3' => 'val3', 'k4' => 'val4'];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    public function test(): void
    {
        $fn = (static fn ($v, $k, iterable $collection) => is_int($k) ? (2 != $k) : (3 != $v[3]));
        self::assertSame([0 => 'value1', 1 => 'value2'], drop_last($this->list, $fn));
        self::assertSame([2 => 'value3', 3 => 'value4'], drop_first($this->list, $fn));
        self::assertSame([2 => 'value3', 3 => 'value4'], drop_first($this->listIterator, $fn));
        self::assertSame([0 => 'value1', 1 => 'value2'], drop_last($this->listIterator, $fn));
        self::assertSame(['k3' => 'val3', 'k4' => 'val4'], drop_first($this->hash, $fn));
        self::assertSame(['k1' => 'val1', 'k2' => 'val2'], drop_last($this->hash, $fn));
        self::assertSame(['k3' => 'val3', 'k4' => 'val4'], drop_first($this->hashIterator, $fn));
        self::assertSame(['k1' => 'val1', 'k2' => 'val2'], drop_last($this->hashIterator, $fn));
    }

    public static function getFunctions(): array
    {
        return [['Functional\drop_first'], ['Functional\drop_last']];
    }

    #[DataProvider('getFunctions')]
    public function testExceptionIsThrownInArray($fn): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        $fn($this->list, $this->exception(...));
    }

    #[DataProvider('getFunctions')]
    public function testExceptionIsThrownInHash($fn): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        $fn($this->hash, $this->exception(...));
    }

    #[DataProvider('getFunctions')]
    public function testExceptionIsThrownInIterator($fn): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        $fn($this->listIterator, $this->exception(...));
    }

    #[DataProvider('getFunctions')]
    public function testExceptionIsThrownInHashIterator($fn): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        $fn($this->hashIterator, $this->exception(...));
    }

    #[DataProvider('getFunctions')]
    public function testPassNonCallable($fn): void
    {
        $this->expectCallableArgumentError($fn, 2);
        $fn($this->list, 'undefinedFunction');
    }
}
