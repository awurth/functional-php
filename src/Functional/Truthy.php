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
 * Returns true if all elements of the collection evaluate to true.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function truthy(iterable $collection): bool
{
    foreach ($collection as $value) {
        if (!$value) {
            return false;
        }
    }

    return true;
}
