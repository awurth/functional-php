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
use Traversable;

use function Functional\last;

class LastTest extends AbstractTestCase
{
    /** @var string[] */
    private $badArray;

    /** @var Traversable|string[] */
    private $badIterator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->list = ['first', 'second', 'third', 'fourth'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->badArray = ['foo', 'bar', 'baz'];
        $this->badIterator = new ArrayIterator($this->badArray);
    }

    public function test(): void
    {
        $fn = static function ($v, $k, $collection) {
            InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

            return ('first' == $v && 0 == $k) || ('third' == $v && 2 == $k);
        };

        self::assertSame('third', last($this->list, $fn));
        self::assertSame('third', last($this->listIterator, $fn));
        self::assertNull(last($this->badArray, $fn));
        self::assertNull(last($this->badIterator, $fn));
    }

    public function testWithoutCallback(): void
    {
        self::assertSame('fourth', last($this->list));
        self::assertSame('fourth', last($this->list, null));
        self::assertSame('fourth', last($this->listIterator));
        self::assertSame('fourth', last($this->listIterator, null));
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\last', 2);
        last($this->list, 'undefinedFunction');
    }

    public function testExceptionIsThrownInArray(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        last($this->list, $this->exception(...));
    }

    public function testExceptionIsThrownInCollection(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        last($this->listIterator, $this->exception(...));
    }
}
