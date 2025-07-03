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
 * Returns true if every value in the collection passes the callback truthy test. Opposite of Functional\none().
 * Callback arguments will be element, index, collection.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function every(iterable $collection, ?callable $callback = null): bool
{
    if (null === $callback) {
        $callback = id(...);
    }

    foreach ($collection as $index => $element) {
        if (!$callback($element, $index, $collection)) {
            return false;
        }
    }

    return true;
}
