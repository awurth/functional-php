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
 * Returns true if some of the elements in the collection pass the callback truthy test. Short-circuits and stops
 * traversing the collection if a truthy element is found. Callback arguments will be value, index, collection.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function some(iterable $collection, ?callable $callback = null): bool
{
    if (null === $callback) {
        $callback = '\Functional\id';
    }

    foreach ($collection as $index => $element) {
        if ($callback($element, $index, $collection)) {
            return true;
        }
    }

    return false;
}
