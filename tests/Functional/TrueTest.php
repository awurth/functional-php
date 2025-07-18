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
use Functional as F;

final class TrueTest extends AbstractTestCase
{
    private ArrayIterator $falseHashIterator;

    private array $falseHash;

    private ArrayIterator $falseIterator;

    private array $falseArray;

    private ArrayIterator $trueHashIterator;

    private array $trueHash;

    private ArrayIterator $trueIterator;

    private array $trueArray;

    protected function setUp(): void
    {
        parent::setUp();

        $this->trueArray = [true, true, true, true];
        $this->trueIterator = new ArrayIterator($this->trueArray);
        $this->trueHash = ['k1' => true, 'k2' => true, 'k3' => true];
        $this->trueHashIterator = new ArrayIterator($this->trueHash);
        $this->falseArray = [true, 1, true];
        $this->falseIterator = new ArrayIterator($this->falseArray);
        $this->falseHash = ['k1' => true, 'k2' => 1, 'k3' => true];
        $this->falseHashIterator = new ArrayIterator($this->falseHash);
    }

    public function test(): void
    {
        self::assertTrue(F\true([]));
        self::assertTrue(F\true(new ArrayIterator([])));
        self::assertTrue(F\true($this->trueArray));
        self::assertTrue(F\true($this->trueIterator));
        self::assertTrue(F\true($this->trueHash));
        self::assertTrue(F\true($this->trueHashIterator));
        self::assertFalse(F\true($this->falseArray));
        self::assertFalse(F\true($this->falseIterator));
        self::assertFalse(F\true($this->falseHash));
        self::assertFalse(F\true($this->falseHashIterator));
    }
}
