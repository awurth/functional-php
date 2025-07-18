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

use function Functional\some;

final class SomeTest extends AbstractTestCase
{
    private array $goodArray;

    private ArrayIterator $goodIterator;

    private array $badArray;

    private ArrayIterator $badIterator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->goodArray = ['value', 'wrong'];
        $this->goodIterator = new ArrayIterator($this->goodArray);
        $this->badArray = ['wrong', 'wrong', 'wrong'];
        $this->badIterator = new ArrayIterator($this->badArray);
    }

    public function test(): void
    {
        self::assertTrue(some($this->goodArray, $this->functionalCallback(...)));
        self::assertTrue(some($this->goodIterator, $this->functionalCallback(...)));
        self::assertFalse(some($this->badArray, $this->functionalCallback(...)));
        self::assertFalse(some($this->badIterator, $this->functionalCallback(...)));
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\some', 2);
        some($this->goodArray, 'undefinedFunction');
    }

    public function testPassNoCallable(): void
    {
        self::assertTrue(some($this->goodArray));
        self::assertTrue(some($this->goodIterator));
        self::assertTrue(some($this->badArray));
        self::assertTrue(some($this->badIterator));
    }

    public function testExceptionThrownInArray(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        some($this->goodArray, $this->exception(...));
    }

    public function testExceptionThrownInCollection(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        some($this->goodIterator, $this->exception(...));
    }

    public function functionalCallback($value, $key, iterable $collection): bool
    {
        return 'value' === $value && 0 === $key;
    }
}
