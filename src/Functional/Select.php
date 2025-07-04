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
 * Looks through each element in the list, returning an array of all the elements that pass a truthy test (callback).
 * Opposite is Functional\reject(). Callback arguments will be element, index, collection.
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
function select(iterable $collection, ?callable $callback = null): array
{
    $aggregation = [];

    if (null === $callback) {
        $callback = id(...);
    }

    foreach ($collection as $index => $element) {
        if ($callback($element, $index, $collection)) {
            $aggregation[$index] = $element;
        }
    }

    return $aggregation;
}
