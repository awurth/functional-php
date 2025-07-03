<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Functional\Exceptions\InvalidArgumentException;

use function is_callable;

/**
 * Calls the method named by $methodName on first object in the collection containing a callable method named
 * $methodName. Any extra arguments passed to invoke will be forwarded on to the method invocation.
 *
 * @param iterable<mixed, mixed> $collection
 * @param string                 $methodName
 *
 * @no-named-arguments
 */
function invoke_first(iterable $collection, $methodName, array $arguments = [])
{
    InvalidArgumentException::assertMethodName($methodName, __FUNCTION__, 2);

    foreach ($collection as $element) {
        $callback = [$element, $methodName];
        if (is_callable($callback)) {
            return $callback(...$arguments);
        }
    }

    return null;
}
