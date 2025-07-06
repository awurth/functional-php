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
 * Returns the elements in list without the elements that the truthy test (callback) passes. The opposite of
 * Functional\select(). Callback arguments will be element, index, collection.
 *
 * @template TKey
 * @template TValue
 *
 * @param iterable<TKey, TValue> $collection
 *
 * @return array<TKey, TValue>
 *
 * @no-named-arguments
 */
function reject(iterable $collection, ?callable $callback = null): array
{
    $aggregation = [];

    if (null === $callback) {
        $callback = id(...);
    }

    foreach ($collection as $index => $element) {
        if (!$callback($element, $index, $collection)) {
            $aggregation[$index] = $element;
        }
    }

    return $aggregation;
}
