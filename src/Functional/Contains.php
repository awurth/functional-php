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
 * Returns true if the collection contains the given value.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function contains(iterable $collection, mixed $value): bool
{
    foreach ($collection as $element) {
        if ($value === $element) {
            return true;
        }
    }

    return false;
}
