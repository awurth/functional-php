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
 * Wrap value within a function, which will return it, without any modifications.
 *
 * @no-named-arguments
 */
function const_function(mixed $value): Closure
{
    return static fn () => $value;
}
