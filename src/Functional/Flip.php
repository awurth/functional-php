<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use function array_reverse;
use function func_get_args;

/**
 * Return a version of the given function where the arguments are provided in reverse order.
 *
 * If one argument is provided, it is passed to the function without change.
 *
 * @param callable $callback the function you want to flip
 *
 * @return callable a flipped version of the given function
 *
 * @no-named-arguments
 */
function flip(callable $callback)
{
    return static function () use ($callback) {
        return $callback(...array_reverse(func_get_args()));
    };
}
