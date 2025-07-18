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

final class FirstTest extends AbstractTestCase
{
    private array $badArray;

    private ArrayIterator $badIterator;

    public static function getAliases(): array
    {
        return [
            ['Functional\first'],
            ['Functional\head'],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->list = ['first', 'second', 'third'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->badArray = ['foo', 'bar', 'baz'];
        $this->badIterator = new ArrayIterator($this->badArray);
    }

    #[DataProvider('getAliases')]
    public function test(string $functionName): void
    {
        $callback = (static fn ($v, $k, iterable $collection) => 'second' === $v && 1 == $k);

        self::assertSame('second', $functionName($this->list, $callback));
        self::assertSame('second', $functionName($this->listIterator, $callback));
        self::assertNull($functionName($this->badArray, $callback));
        self::assertNull($functionName($this->badIterator, $callback));
    }

    #[DataProvider('getAliases')]
    public function testWithoutCallback($functionName): void
    {
        self::assertSame('first', $functionName($this->list));
        self::assertSame('first', $functionName($this->list, null));
        self::assertSame('first', $functionName($this->listIterator));
        self::assertSame('first', $functionName($this->listIterator, null));
        self::assertSame('foo', $functionName($this->badArray));
        self::assertSame('foo', $functionName($this->badArray, null));
        self::assertSame('foo', $functionName($this->badIterator));
        self::assertSame('foo', $functionName($this->badIterator, null));
    }

    #[DataProvider('getAliases')]
    public function testPassNonCallable($functionName): void
    {
        $this->expectCallableArgumentError($functionName, 2);
        $functionName($this->list, 'undefinedFunction');
    }

    #[DataProvider('getAliases')]
    public function testExceptionIsThrownInArray($functionName): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        $functionName($this->list, $this->exception(...));
    }

    #[DataProvider('getAliases')]
    public function testExceptionIsThrownInCollection($functionName): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        $functionName($this->listIterator, $this->exception(...));
    }
}
