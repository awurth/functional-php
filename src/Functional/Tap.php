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
 * Call the given Closure with the given value, then return the value.
 *
 * @template T
 *
 * @param T                 $value
 * @param callable(T): void $callback
 *
 * @return T
 *
 * @no-named-arguments
 */
function tap(mixed $value, callable $callback): mixed
{
    $callback($value);

    return $value;
}
