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
 * Returns all items from $collection except first element (head). Preserves $collection keys.
 * Takes an optional callback for filtering the collection.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function tail(iterable $collection, ?callable $callback = null): array
{
    $tail = [];
    $isHead = true;

    foreach ($collection as $index => $element) {
        if ($isHead) {
            $isHead = false;

            continue;
        }

        if (!$callback || $callback($element, $index, $collection)) {
            $tail[$index] = $element;
        }
    }

    return $tail;
}
