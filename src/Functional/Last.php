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
 * Looks through each element in the collection, returning the last one that passes a truthy test (callback).
 * Callback arguments will be element, index, collection.
 *
 * @template TKey
 * @template TValue
 *
 * @param iterable<TKey, TValue> $collection
 *
 * @return TValue|null
 *
 * @no-named-arguments
 */
function last(iterable $collection, ?callable $callback = null): mixed
{
    $match = null;
    foreach ($collection as $index => $element) {
        if (null === $callback || $callback($element, $index, $collection)) {
            $match = $element;
        }
    }

    return $match;
}
