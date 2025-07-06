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

use function is_callable;

/**
 * Returns a function that expects an object as the first param and tries to invoke the given method on it.
 *
 * @no-named-arguments
 */
function partial_method(string $methodName, array $arguments = [], $defaultValue = null): Closure
{
    return static function ($object) use ($methodName, $arguments, $defaultValue) {
        if (!is_callable([$object, $methodName])) {
            return $defaultValue;
        }

        return $object->{$methodName}(...$arguments);
    };
}
