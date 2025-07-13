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

/** @internal */
class LinearSequence implements Iterator
{
    private int $start;

    private int $amount;

    private int $value;

    public function __construct(int $start, int $amount)
    {
        InvalidArgumentException::assertIntegerGreaterThanOrEqual($start, 0, __METHOD__, 1);

        $this->start = $start;
        $this->amount = $amount;
        $this->value = $start;
    }

    public function current(): int
    {
        return $this->value;
    }

    public function next(): void
    {
        $this->value += $this->amount;
    }

    public function key(): int
    {
        return 0;
    }

    public function valid(): bool
    {
        return true;
    }

    public function rewind(): void
    {
        $this->value = $this->start;
    }
}
