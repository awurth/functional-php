<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use function array_pop;

/**
 * Insert a given value between each element of a collection.
 * Indices are not preserved.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function intersperse(iterable $collection, $glue): array
{
    $aggregation = [];

    foreach ($collection as $element) {
        $aggregation[] = $element;
        $aggregation[] = $glue;
    }

    array_pop($aggregation);

    return $aggregation;
}
