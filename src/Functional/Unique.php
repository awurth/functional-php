<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use function in_array;

/**
 * Returns an array of unique elements.
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
function unique(iterable $collection, ?callable $callback = null): array
{
    $indexes = [];
    $aggregation = [];
    foreach ($collection as $key => $element) {
        $index = null !== $callback ? $callback($element, $key, $collection) : $element;

        if (!in_array($index, $indexes, true)) {
            $aggregation[$key] = $element;

            $indexes[] = $index;
        }
    }

    return $aggregation;
}
