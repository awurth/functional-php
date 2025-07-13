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

use function array_reduce;

/**
 * Return a new function that composes all functions in $functions into a single callable.
 *
 * @no-named-arguments
 */
function compose(callable ...$functions): Closure
{
    return array_reduce(
        $functions,
        static fn (callable $carry, callable $item): Closure => static fn (mixed $x) => $item($carry($x)),
        id(...),
    );
}
