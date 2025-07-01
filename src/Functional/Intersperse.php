<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Functional\Exceptions\InvalidArgumentException;
use Traversable;

use function array_pop;

/**
 * Insert a given value between each element of a collection.
 * Indices are not preserved.
 *
 * @param array|Traversable $collection
 *
 * @return array
 *
 * @no-named-arguments
 */
function intersperse($collection, $glue)
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

    $aggregation = [];

    foreach ($collection as $element) {
        $aggregation[] = $element;
        $aggregation[] = $glue;
    }

    array_pop($aggregation);

    return $aggregation;
}
