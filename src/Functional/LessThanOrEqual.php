<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Closure;

/**
 * Returns true if $a is less than or equal to $b.
 *
 * @return Closure(mixed): bool
 *
 * @no-named-arguments
 */
function less_than_or_equal(mixed $b): Closure
{
    return static fn (mixed $a): bool => $a <= $b;
}
