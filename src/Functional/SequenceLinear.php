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

/**
 * Returns an infinite, traversable sequence that linearly grows by given amount.
 *
 * @no-named-arguments
 */
function sequence_linear(int $start, int $amount): LinearSequence
{
    InvalidArgumentException::assertIntegerGreaterThanOrEqual($start, 0, __FUNCTION__, 1);

    return new LinearSequence($start, $amount);
}
