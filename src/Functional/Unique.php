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

use function in_array;

/**
 * Returns an array of unique elements.
 *
 * @param array|Traversable $collection
 * @param bool              $strict
 *
 * @no-named-arguments
 */
function unique($collection, ?callable $callback = null, $strict = true): array
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

    $indexes = [];
    $aggregation = [];
    foreach ($collection as $key => $element) {
        $index = $callback ? $callback($element, $key, $collection) : $element;

        if (!in_array($index, $indexes, $strict)) {
            $aggregation[$key] = $element;

            $indexes[] = $index;
        }
    }

    return $aggregation;
}
