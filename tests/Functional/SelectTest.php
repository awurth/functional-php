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

use function Functional\select;

final class SelectTest extends AbstractTestCase
{
    public static function getAliases(): array
    {
        return [
            ['Functional\select'],
            ['Functional\filter'],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->list = ['value', 'wrong', 'value'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = ['k1' => 'value', 'k2' => 'wrong', 'k3' => 'value'];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    #[DataProvider('getAliases')]
    public function test($functionName): void
    {
        $callback = (static fn ($v, $k, iterable $collection) => 'value' === $v && '' !== $k);
        self::assertSame(['value', 2 => 'value'], $functionName($this->list, $callback));
        self::assertSame(['value', 2 => 'value'], $functionName($this->listIterator, $callback));
        self::assertSame(['k1' => 'value', 'k3' => 'value'], $functionName($this->hash, $callback));
        self::assertSame(['k1' => 'value', 'k3' => 'value'], $functionName($this->hashIterator, $callback));
    }

    #[DataProvider('getAliases')]
    public function testPassNonCallable($functionName): void
    {
        $this->expectCallableArgumentError($functionName, 2);
        $functionName($this->list, 'undefinedFunction');
    }

    public function testPassNoCallable(): void
    {
        self::assertSame(['value', 'wrong', 'value'], select($this->list));
        self::assertSame(['value', 'wrong', 'value'], select($this->listIterator));
        self::assertSame(['k1' => 'value', 'k2' => 'wrong', 'k3' => 'value'], select($this->hash));
        self::assertSame(['k1' => 'value', 'k2' => 'wrong', 'k3' => 'value'], select($this->hashIterator));
        self::assertSame([0 => true, 2 => true], select([true, false, true]));
    }

    #[DataProvider('getAliases')]
    public function testExceptionIsThrownInArray($functionName): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        $functionName($this->list, $this->exception(...));
    }

    #[DataProvider('getAliases')]
    public function testExceptionIsThrownInHash($functionName): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        $functionName($this->hash, $this->exception(...));
    }

    #[DataProvider('getAliases')]
    public function testExceptionIsThrownInIterator($functionName): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        $functionName($this->listIterator, $this->exception(...));
    }

    #[DataProvider('getAliases')]
    public function testExceptionIsThrownInHashIterator($functionName): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        $functionName($this->hashIterator, $this->exception(...));
    }
}
