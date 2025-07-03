<?php

/**
 * @author    Hugo Sales <hugo@hsal.es>
 * @copyright 2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

/**
 * Inspired by JavaScript’s `Object.entries`, and Python’s `enumerate`,
 * convert a key-value map into an array of key-value pairs.
 *
 * @see from_entries
 *
 * @template TKey
 * @template TValue
 *
 * @param iterable<TKey, TValue> $collection
 *
 * @return array<int, array<int, TKey|TValue>>
 *
 * @no-named-arguments
 */
function entries(iterable $collection, int $start = 0): array
{
    $aggregation = [];
    foreach ($collection as $key => $value) {
        $aggregation[$start++] = [$key, $value];
    }

    return $aggregation;
}
