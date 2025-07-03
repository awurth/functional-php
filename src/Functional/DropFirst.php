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
 * Drop all elements from a collection until callback returns false.
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
function drop_first(iterable $collection, callable $callback): array
{
    $result = [];

    $drop = true;
    foreach ($collection as $index => $element) {
        if ($drop) {
            if ($callback($element, $index, $collection)) {
                continue;
            }

            $drop = false;
        }

        $result[$index] = $element;
    }

    return $result;
}
