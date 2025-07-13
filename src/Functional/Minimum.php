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
 * Returns the minimum value of a collection.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function minimum(iterable $collection): float|int|string|null
{
    $min = null;

    foreach ($collection as $element) {
        if (!is_numeric($element)) {
            continue;
        }

        if ($element < $min || null === $min) {
            $min = $element;
        }
    }

    return $min;
}
