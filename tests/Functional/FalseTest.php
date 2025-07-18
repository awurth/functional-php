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

final class FalseTest extends AbstractTestCase
{
    private array $trueArray;

    private ArrayIterator $trueIterator;

    private array $trueHash;

    private ArrayIterator $trueHashIterator;

    private array $falseArray;

    private ArrayIterator $falseIterator;

    private array $falseHash;

    private ArrayIterator $falseHashIterator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->trueArray = [false, false, false, false];
        $this->trueIterator = new ArrayIterator($this->trueArray);
        $this->trueHash = ['k1' => false, 'k2' => false, 'k3' => false];
        $this->trueHashIterator = new ArrayIterator($this->trueHash);
        $this->falseArray = [false, 0, false, 'foo', [], (object) []];
        $this->falseIterator = new ArrayIterator($this->falseArray);
        $this->falseHash = ['k1' => false, 'k2' => 0, 'k3' => false];
        $this->falseHashIterator = new ArrayIterator($this->falseHash);
    }

    public function test(): void
    {
        self::assertTrue(F\false([]));
        self::assertTrue(F\false(new ArrayIterator([])));
        self::assertTrue(F\false($this->trueArray));
        self::assertTrue(F\false($this->trueIterator));
        self::assertTrue(F\false($this->trueHash));
        self::assertTrue(F\false($this->trueHashIterator));
        self::assertFalse(F\false($this->falseArray));
        self::assertFalse(F\false($this->falseIterator));
        self::assertFalse(F\false($this->falseHash));
        self::assertFalse(F\false($this->falseHashIterator));
    }
}
