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
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function last(iterable $collection, ?callable $callback = null)
{
    $match = null;
    foreach ($collection as $index => $element) {
        if (null === $callback || $callback($element, $index, $collection)) {
            $match = $element;
        }
    }

    return $match;
}
