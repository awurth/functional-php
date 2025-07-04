<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Functional\Exceptions\InvalidArgumentException;
use Functional\Sequences\LinearSequence;
use Traversable;

/**
 * Returns an infinite, traversable sequence that linearly grows by given amount.
 *
 * @param int $start
 * @param int $amount
 *
 * @return Traversable
 *
 * @no-named-arguments
 */
function sequence_linear($start, $amount): LinearSequence
{
    InvalidArgumentException::assertIntegerGreaterThanOrEqual($start, 0, __FUNCTION__, 1);
    InvalidArgumentException::assertInteger($amount, __FUNCTION__, 2);

    return new LinearSequence($start, $amount);
}
