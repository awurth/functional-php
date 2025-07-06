<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use function is_callable;

/**
 * Calls the method named by $methodName on $object. Any extra arguments passed to invoke_if will be
 * forwarded on to the method invocation. If $method is not callable on $object, $defaultValue is returned.
 *
 * @no-named-arguments
 */
function invoke_if($object, string $methodName, array $methodArguments = [], mixed $defaultValue = null): mixed
{
    $callback = [$object, $methodName];
    if (is_callable($callback)) {
        return $callback(...$methodArguments);
    }

    return $defaultValue;
}
