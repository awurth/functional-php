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
 * Returns the first index holding specified value in the collection. Returns false if value was not found.
 *
 * @template TKey
 * @template TValue
 *
 * @param iterable<TKey, TValue> $collection
 *
 * @return TKey|false
 *
 * @no-named-arguments
 */
function first_index_of(iterable $collection, mixed $value): mixed
{
    if (is_callable($value)) {
        foreach ($collection as $index => $element) {
            if ($value($element, $index, $collection) === $element) {
                return $index;
            }
        }
    } else {
        foreach ($collection as $index => $element) {
            if ($element === $value) {
                return $index;
            }
        }
    }

    return false;
}
