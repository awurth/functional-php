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
 * Returns true if $a is equal to $b, and they are of the same type.
 *
 * @return callable
 *
 * @no-named-arguments
 */
function identical($b)
{
    return static fn ($a): bool => $a === $b;
}
