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
 * Logical negation of the given $function.
 *
 * @param callable $function The function to run value against
 *
 * @return Closure A negation version on the given $function
 *
 * @no-named-arguments
 */
function not(callable $function): Closure
{
    return static fn ($value): bool => !$function($value);
}
