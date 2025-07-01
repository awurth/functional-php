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
 * Returns an integer less than, equal to, or greater than zero when
 * $a is respectively less than, equal to, or greater than $b.
 *
 * @return Closure(mixed)
 *
 * @no-named-arguments
 */
function lexicographic_compare($b)
{
    return static fn($a) => $a <=> $b;
}
