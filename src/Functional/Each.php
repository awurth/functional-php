<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

/**
 * Iterates over a collection of elements, yielding each in turn to a callback function. Each invocation of $callback
 * is called with three arguments: (element, index, collection).
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function each(iterable $collection, callable $callback): void
{
    foreach ($collection as $index => $element) {
        $callback($element, $index, $collection);
    }
}
