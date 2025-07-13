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
 * Returns a list of array indexes, either matching the predicate or strictly equal to the passed value. Returns an
 * empty array if no values were found.
 *
 * @template TKey
 *
 * @param iterable<TKey, mixed> $collection
 * @param callable|mixed        $value
 *
 * @return array<int, TKey>
 *
 * @no-named-arguments
 */
function indexes_of(iterable $collection, mixed $value): array
{
    $result = [];

    if (is_callable($value)) {
        foreach ($collection as $index => $element) {
            if ($value($element, $index, $collection) === $element) {
                $result[] = $index;
            }
        }
    } else {
        foreach ($collection as $index => $element) {
            if ($element === $value) {
                $result[] = $index;
            }
        }
    }

    return $result;
}
