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
use Functional\Exceptions\InvalidArgumentException;

use function Functional\none;

final class NoneTest extends AbstractTestCase
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
        $this->badArray = ['value', 'value', 'foo'];
        $this->badIterator = new ArrayIterator($this->badArray);
    }

    public function test(): void
    {
        self::assertTrue(none($this->goodArray, $this->functionalCallback(...)));
        self::assertTrue(none($this->goodIterator, $this->functionalCallback(...)));
        self::assertFalse(none($this->badArray, $this->functionalCallback(...)));
        self::assertFalse(none($this->badIterator, $this->functionalCallback(...)));
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\none', 2);
        none($this->goodArray, 'undefinedFunction');
    }

    public function testPassNoCallable(): void
    {
        self::assertFalse(none($this->goodArray));
        self::assertFalse(none($this->goodIterator));
        self::assertFalse(none($this->badArray));
        self::assertFalse(none($this->badIterator));
    }

    public function testExceptionIsThrownInArray(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        none($this->goodArray, $this->exception(...));
    }

    public function testExceptionIsThrownInIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        none($this->goodIterator, $this->exception(...));
    }

    public function functionalCallback($value, $key, $collection): bool
    {
        InvalidArgumentException::assertCollection($collection, __FUNCTION__, 3);

        return 'value' !== $value && '' !== $key;
    }
}
