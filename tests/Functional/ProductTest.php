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

use function Functional\product;

final class ProductTest extends AbstractTestCase
{
    private array $intArray;

    private ArrayIterator $intIterator;

    private array $floatArray;

    private ArrayIterator $floatIterator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->intArray = [1 => 1, 2, 'foo' => 3, 4];
        $this->intIterator = new ArrayIterator($this->intArray);
        $this->floatArray = ['foo' => 1.5, 1.1, 1];
        $this->floatIterator = new ArrayIterator($this->floatArray);
    }

    public function test(): void
    {
        self::assertSame(240, product($this->intArray, 10));
        self::assertSame(240, product($this->intArray, 10));
        self::assertSame(24, product($this->intArray));
        self::assertSame(24, product($this->intIterator));
        self::assertEqualsWithDelta(1.65, product($this->floatArray), 0.01, '');
        self::assertEqualsWithDelta(1.65, product($this->floatIterator), 0.01, '');
    }

    /** @dataProvider \Functional\Tests\MathDataProvider::injectErrorCollection */
    public function testElementsOfWrongTypeAreIgnored($collection): void
    {
        self::assertEqualsWithDelta(3, product($collection), 0.01, '');
    }
}
