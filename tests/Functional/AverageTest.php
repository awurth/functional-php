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

use function array_values;
use function Functional\average;

final class AverageTest extends AbstractTestCase
{
    private array $list2;

    private ArrayIterator $listIterator2;

    private array $list3;

    private ArrayIterator $listIterator3;

    private array $hash2;

    private ArrayIterator $hashIterator2;

    private array $hash3;

    private ArrayIterator $hashIterator3;

    protected function setUp(): void
    {
        $this->hash = ['f0' => 12, 'f1' => 2, 'f3' => true, 'f4' => false, 'f5' => 'str', 'f6' => [], 'f7' => new stdClass(), 'f8' => 1];
        $this->hashIterator = new ArrayIterator($this->hash);
        $this->list = array_values($this->hash);
        $this->listIterator = new ArrayIterator($this->list);

        $this->hash2 = ['f0' => 1.0, 'f1' => 0.5, 'f3' => true, 'f4' => false, 'f5' => 1];
        $this->hashIterator2 = new ArrayIterator($this->hash2);
        $this->list2 = array_values($this->hash2);
        $this->listIterator2 = new ArrayIterator($this->list2);

        $this->hash3 = ['f0' => [], 'f1' => new stdClass(), 'f2' => null, 'f3' => 'foo'];
        $this->hashIterator3 = new ArrayIterator($this->hash3);
        $this->list3 = array_values($this->hash3);
        $this->listIterator3 = new ArrayIterator($this->list3);
    }

    public function test(): void
    {
        self::assertSame(5, average($this->hash));
        self::assertSame(5, average($this->hashIterator));
        self::assertSame(5, average($this->list));
        self::assertSame(5, average($this->listIterator));

        self::assertEqualsWithDelta(0.833333333, average($this->hash2), 0.001);
        self::assertEqualsWithDelta(0.833333333, average($this->hashIterator2), 0.001);
        self::assertEqualsWithDelta(0.833333333, average($this->list2), 0.001);
        self::assertEqualsWithDelta(0.833333333, average($this->listIterator2), 0.001);

        self::assertNull(average($this->hash3));
        self::assertNull(average($this->hashIterator3));
        self::assertNull(average($this->list3));
        self::assertNull(average($this->listIterator3));
    }
}
