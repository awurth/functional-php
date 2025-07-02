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
 * Returns the average of all numeric values in the array or null if no numeric value was found.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function average(iterable $collection): int|float|null
{
    $sum = null;
    $divisor = 0;

    foreach ($collection as $element) {
        if (is_numeric($element)) {
            $sum = ($sum ?? 0) + $element;
            ++$divisor;
        }
    }

    if (null === $sum) {
        return null;
    }

    return $sum / $divisor;
}
