<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use function array_reduce;

/**
 * Return a new function that composes all functions in $functions into a single callable.
 *
 * @no-named-arguments
 */
function compose(callable ...$functions): callable
{
    return array_reduce(
        $functions,
        static fn ($carry, $item) => static fn ($x) => $item($carry($x)),
        'Functional\id',
    );
}
