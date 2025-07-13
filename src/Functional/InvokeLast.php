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
 * Calls the method named by $methodName on last object in the collection containing a callable method named
 * $methodName. Any extra arguments passed to invoke will be forwarded on to the method invocation.
 *
 * @param iterable<mixed, mixed> $collection
 * @param array<mixed, mixed>    $arguments
 *
 * @no-named-arguments
 */
function invoke_last(iterable $collection, string $methodName, array $arguments = []): mixed
{
    $lastCallback = null;

    foreach ($collection as $element) {
        $callback = [$element, $methodName];
        if (is_callable($callback)) {
            $lastCallback = $callback;
        }
    }

    if (!is_callable($lastCallback)) {
        return null;
    }

    return $lastCallback(...$arguments);
}
