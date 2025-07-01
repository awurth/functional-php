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
 * Returns true if $a is strictly greater than $b.
 *
 * @return Closure(mixed)
 *
 * @no-named-arguments
 */
function greater_than($b)
{
    return static fn ($a): bool => $a > $b;
}
