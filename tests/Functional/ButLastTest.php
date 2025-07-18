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

use function Functional\but_last;

class ButLastTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->list = [1, 2, 3, 4];
        $this->listIterator = new ArrayIterator($this->list);
    }

    public function test(): void
    {
        self::assertSame([0 => 1, 1 => 2, 2 => 3], but_last($this->list));
        self::assertSame([0 => 1, 1 => 2, 2 => 3], but_last($this->listIterator));
        self::assertSame([], but_last([]));
    }
}
