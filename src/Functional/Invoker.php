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
 * Returns a function that invokes method `$method` with arguments `$methodArguments` on the object.
 *
 * @param array<mixed, mixed> $arguments
 *
 * @no-named-arguments
 */
function invoker(string $methodName, array $arguments = []): Closure
{
    return static fn (object $object): mixed => $object->{$methodName}(...$arguments);
}
