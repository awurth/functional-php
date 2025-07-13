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

/**
 * Return a new function with the arguments partially applied starting from the left side.
 *
 * Use Functional\…, Functional\…() or Functional\placeholder() as a placeholder
 *
 * @no-named-arguments
 */
function partial_left(callable $callback, mixed ...$arguments): Closure
{
    return static fn (mixed ...$innerArguments) => $callback(...array_merge($arguments, $innerArguments));
}
