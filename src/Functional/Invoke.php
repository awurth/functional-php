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
 * Calls the method named by $methodName on each value in the collection. Any extra arguments passed to invoke will be
 * forwarded on to the method invocation.
 *
 * @param iterable<mixed, mixed> $collection
 * @param string                 $methodName
 *
 * @no-named-arguments
 */
function invoke(iterable $collection, $methodName, array $arguments = []): array
{
    InvalidArgumentException::assertMethodName($methodName, __FUNCTION__, 2);

    $aggregation = [];

    foreach ($collection as $index => $element) {
        $value = null;

        $callback = [$element, $methodName];
        if (is_callable($callback)) {
            $value = $callback(...$arguments);
        }

        $aggregation[$index] = $value;
    }

    return $aggregation;
}
