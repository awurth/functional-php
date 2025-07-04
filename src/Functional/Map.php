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
 * @template TKey
 * @template TValue
 * @template TReturn
 *
 * @param iterable<TKey, TValue>                                  $collection
 * @param callable(TValue, TKey, iterable<TKey, TValue>): TReturn $callback
 *
 * @return array<TKey, TReturn>
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
