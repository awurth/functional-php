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
use PHPUnit\Framework\Attributes\DataProviderExternal;

use function Functional\ratio;

final class RatioTest extends AbstractTestCase
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
        self::assertSame(1, ratio([1]));
        self::assertSame(1, ratio(new ArrayIterator([1])));
        self::assertSame(1, ratio($this->intArray, 24));
        self::assertSame(1, ratio($this->intIterator, 24));
        self::assertEqualsWithDelta(-1, ratio($this->floatArray, -1.65), 0.01);
        self::assertEqualsWithDelta(-1, ratio($this->floatIterator, -1.65), 0.01);
    }

    #[DataProviderExternal(MathDataProvider::class, 'injectErrorCollection')]
    public function testElementsOfWrongTypeAreIgnored($collection): void
    {
        self::assertEqualsWithDelta(0.333, ratio($collection), 0.001);
    }
}
