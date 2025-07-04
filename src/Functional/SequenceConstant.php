<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use ArrayIterator;
use Functional\Exceptions\InvalidArgumentException;
use InfiniteIterator;
use Traversable;

/**
 * Returns an infinite, traversable sequence of constant values.
 *
 * @param int $value
 *
 * @return Traversable
 *
 * @no-named-arguments
 */
function sequence_constant($value): InfiniteIterator
{
    InvalidArgumentException::assertIntegerGreaterThanOrEqual($value, 0, __FUNCTION__, 1);

    return new InfiniteIterator(new ArrayIterator([$value]));
}
