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
 * @param iterable<mixed, mixed> $collection
 * @param bool                   $strict
 *
 * @no-named-arguments
 */
function unique(iterable $collection, ?callable $callback = null, $strict = true): array
{
    $indexes = [];
    $aggregation = [];
    foreach ($collection as $key => $element) {
        $index = $callback ? $callback($element, $key, $collection) : $element;

        if (!in_array($index, $indexes, $strict)) {
            $aggregation[$key] = $element;

            $indexes[] = $index;
        }
    }

    return $aggregation;
}
