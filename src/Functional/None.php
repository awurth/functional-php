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
 * Returns true if all the elements in the collection pass the callback falsy test. Opposite of Functional\all().
 * Callback arguments will be element, index, collection.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function none(iterable $collection, ?callable $callback = null): bool
{
    if (null === $callback) {
        $callback = id(...);
    }

    foreach ($collection as $index => $element) {
        if ($callback($element, $index, $collection)) {
            return false;
        }
    }

    return true;
}
