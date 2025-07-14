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

use function Functional\every;
use function is_numeric;

final class EveryTest extends AbstractTestCase
{
    private array $goodArray;

    private ArrayIterator $goodIterator;

    private array $badArray;

    private ArrayIterator $badIterator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->goodArray = ['value', 'value', 'value'];
        $this->goodIterator = new ArrayIterator($this->goodArray);
        $this->badArray = ['value', 'nope', 'value'];
        $this->badIterator = new ArrayIterator($this->badArray);
    }

    public function test(): void
    {
        self::assertTrue(every($this->goodArray, $this->functionalCallback(...)));
        self::assertTrue(every($this->goodIterator, $this->functionalCallback(...)));
        self::assertFalse(every($this->badArray, $this->functionalCallback(...)));
        self::assertFalse(every($this->badIterator, $this->functionalCallback(...)));
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\every', 2);
        every($this->goodArray, 'undefinedFunction');
    }

    public function testPassNoCallable(): void
    {
        self::assertTrue(every($this->goodArray));
        self::assertTrue(every($this->goodIterator));
        self::assertTrue(every($this->badArray));
        self::assertTrue(every($this->badIterator));
    }

    public function testExceptionIsThrownInArray(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        every($this->goodArray, $this->exception(...));
    }

    public function testExceptionIsThrownInCollection(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        every($this->goodIterator, $this->exception(...));
    }

    public function functionalCallback($value, $key, iterable $collection): bool
    {
        return 'value' === $value && is_numeric($key);
    }
}
