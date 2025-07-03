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
use ReflectionFunction;

/**
 * Return a curryied version of the given function. You can decide if you also
 * want to curry optional parameters or not.
 *
 * @param callable $function the function to curry
 * @param bool     $required curry optional parameters ?
 *
 * @return Closure a curryied version of the given function
 *
 * @no-named-arguments
 */
function curry(callable $function, bool $required = true): Closure
{
    $reflection = new ReflectionFunction(Closure::fromCallable($function));

    $count = $required
        ? $reflection->getNumberOfRequiredParameters()
        : $reflection->getNumberOfParameters();

    return curry_n($count, $function);
}
