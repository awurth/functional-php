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
 * Looks through each element in the collection, returning the first one that passes a truthy test (callback). The
 * function returns as soon as it finds an acceptable element, and doesn't traverse the entire collection. Callback
 * arguments will be element, index, collection.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function first(iterable $collection, ?callable $callback = null)
{
    foreach ($collection as $index => $element) {
        if (null === $callback) {
            return $element;
        }

        if ($callback($element, $index, $collection)) {
            return $element;
        }
    }

    return null;
}
