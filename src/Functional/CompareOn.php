<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

/**
 * Returns a comparison function that can be used with e.g. `usort()`.
 *
 * @param callable $comparison A function that compares the two values. Pick e.g. strcmp() or strnatcasecmp()
 * @param callable $reducer    A function that takes an argument and returns the value that should be compared
 *
 * @return callable
 *
 * @no-named-arguments
 */
function compare_on(callable $comparison, ?callable $reducer = null)
{
    if (null === $reducer) {
        return static fn ($left, $right) => $comparison($left, $right);
    }

    return static fn ($left, $right) => $comparison($reducer($left), $reducer($right));
}
