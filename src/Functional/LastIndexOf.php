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
 * Returns the last index holding specified value in the collection. Returns false if value was not found.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function last_index_of(iterable $collection, $value)
{
    $matchingIndex = false;

    if (is_callable($value)) {
        foreach ($collection as $index => $element) {
            if ($value($element, $index, $collection) === $element) {
                $matchingIndex = $index;
            }
        }
    } else {
        foreach ($collection as $index => $element) {
            if ($element === $value) {
                $matchingIndex = $index;
            }
        }
    }

    return $matchingIndex;
}
