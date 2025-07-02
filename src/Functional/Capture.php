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
 * Return a new function that captures the return value of $callback in $result and returns the callback's return value.
 *
 * @no-named-arguments
 */
function capture(callable $callback, mixed &$result): Closure
{
    return static function (...$args) use ($callback, &$result) {
        $result = $callback(...$args);

        return $result;
    };
}
