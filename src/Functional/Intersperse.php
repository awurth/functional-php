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
 * @template TKey
 * @template TValue
 * @template TGlue
 *
 * @param iterable<TKey, TValue> $collection
 * @param TGlue                  $glue
 *
 * @return array<int, TValue|TGlue>
 *
 * @no-named-arguments
 */
function intersperse(iterable $collection, mixed $glue): array
{
    $aggregation = [];

    foreach ($collection as $element) {
        $aggregation[] = $element;
        $aggregation[] = $glue;
    }

    array_pop($aggregation);

    return $aggregation;
}
