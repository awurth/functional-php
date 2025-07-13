<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Sequences;

use Functional\Exceptions\InvalidArgumentException;
use Iterator;

use function round;

/** @internal */
class ExponentialSequence implements Iterator
{
    private int $value;

    private int $times = 0;

    public function __construct(
        private readonly int $start,
        private readonly int $percentage,
    ) {
        InvalidArgumentException::assertIntegerGreaterThanOrEqual($start, 1, __METHOD__, 1);
        InvalidArgumentException::assertIntegerGreaterThanOrEqual($percentage, 1, __METHOD__, 2);
        InvalidArgumentException::assertIntegerLessThanOrEqual($percentage, 100, __METHOD__, 2);

        $this->value = $start;
    }

    public function current(): int
    {
        return $this->value;
    }

    public function next(): void
    {
        $this->value = (int) round(($this->start * (1 + $this->percentage / 100)) ** $this->times);
        ++$this->times;
    }

    public function key(): null
    {
        return null;
    }

    public function valid(): true
    {
        return true;
    }

    public function rewind(): void
    {
        $this->times = 1;
        $this->value = $this->start;
    }
}
