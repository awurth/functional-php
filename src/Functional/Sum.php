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
 * Takes a collection and returns the sum of the elements.
 *
 * @param iterable<mixed, mixed> $collection
 * @param float|int              $initial
 *
 * @return float|int
 *
 * @no-named-arguments
 */
function sum(iterable $collection, $initial = 0)
{
    $result = $initial;
    foreach ($collection as $value) {
        if (is_numeric($value)) {
            $result += $value;
        }
    }

    return $result;
}
