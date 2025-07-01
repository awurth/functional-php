<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use function array_merge;

/**
 * Return a new function with the arguments partially applied starting from the right.
 *
 * @param array ...$arguments
 *
 * @return callable
 *
 * @no-named-arguments
 */
function partial_right(callable $callback, ...$arguments)
{
    return static fn(...$innerArguments) => $callback(...array_merge($innerArguments, $arguments));
}
