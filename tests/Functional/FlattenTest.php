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
use stdClass;

use function Functional\flatten;
use function range;

final class FlattenTest extends AbstractTestCase
{
    private array $goodArray;

    private array $goodArray2;

    private ArrayIterator $goodIterator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->goodArray = [1, 2, 3, [4, 5, 6, [7, 8, 9]], 10, [11, [12, 13], 14], 15];
        $this->goodArray2 = [1 => 1, 'foo' => '2', 3 => '3', ['foo' => 5]];
        $this->goodIterator = new ArrayIterator($this->goodArray);
        $this->goodIterator[3] = new ArrayIterator($this->goodIterator[3]);
        $this->goodIterator[5][1] = new ArrayIterator($this->goodIterator[5][1]);
    }

    public function test(): void
    {
        self::assertSame(range(1, 15), flatten($this->goodArray));
        self::assertSame(range(1, 15), flatten($this->goodIterator));
        self::assertSame([1, '2', '3', 5], flatten($this->goodArray2));
        self::assertEquals([new stdClass()], flatten([[new stdClass()]]));
        self::assertSame([null, null], flatten([[null], null]));
    }
}
