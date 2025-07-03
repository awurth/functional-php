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
 * Returns true if all elements of the collection are strictly false.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function false(iterable $collection): bool
{
    foreach ($collection as $value) {
        if (false !== $value) {
            return false;
        }
    }

    return true;
}
