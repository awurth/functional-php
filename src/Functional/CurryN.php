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

use function array_merge;
use function call_user_func_array;
use function count;

/**
 * Return a version of the given function where the $count first arguments are curryied.
 *
 * No check is made to verify that the given argument count is either too low or too high.
 * If you give a smaller number you will have an error when calling the given function. If
 * you give a higher number, arguments will simply be ignored.
 *
 * @param int      $count    number of arguments you want to curry
 * @param callable $function the function you want to curry
 *
 * @return Closure a curryied version of the given function
 *
 * @no-named-arguments
 */
function curry_n(int $count, callable $function): Closure
{
    $accumulator = static function (array $arguments) use ($count, $function, &$accumulator): Closure {
        return static function (...$newArguments) use ($count, $function, $arguments, $accumulator) {
            $arguments = array_merge($arguments, $newArguments);

            if ($count <= count($arguments)) {
                return call_user_func_array($function, $arguments);
            }

            return $accumulator($arguments);
        };
    };

    return $accumulator([]);
}
