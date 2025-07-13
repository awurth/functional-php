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
 * Returns the maximum value of a collection.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function maximum(iterable $collection): float|int|string|null
{
    $max = null;

    foreach ($collection as $element) {
        if (!is_numeric($element)) {
            continue;
        }

        if ($element > $max || null === $max) {
            $max = $element;
        }
    }

    return $max;
}
