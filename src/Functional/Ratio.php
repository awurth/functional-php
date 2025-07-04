<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use function is_numeric;

/**
 * Takes a collection and returns the quotient of all elements.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function ratio(iterable $collection, float|int $initial = 1): float|int
{
    $result = $initial;
    foreach ($collection as $value) {
        if (is_numeric($value)) {
            $result /= $value;
        }
    }

    return $result;
}
