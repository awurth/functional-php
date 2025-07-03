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
 * Produces a new array of elements by mapping each element in collection through a transformation function (callback).
 * Callback arguments will be element, index, collection.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function map(iterable $collection, callable $callback): array
{
    $aggregation = [];

    foreach ($collection as $index => $element) {
        $aggregation[$index] = $callback($element, $index, $collection);
    }

    return $aggregation;
}
