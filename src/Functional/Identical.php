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
 * Returns true if $a is equal to $b, and they are of the same type.
 *
 * @no-named-arguments
 */
function identical(mixed $b): Closure
{
    return static fn (mixed $a): bool => $a === $b;
}
