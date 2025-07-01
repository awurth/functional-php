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

/**
 * Looks through each element in the list, returning an array of all the elements that pass a truthy test (callback).
 * Opposite is Functional\reject(). Callback arguments will be element, index, collection.
 *
 * @param array|Traversable $collection
 *
 * @no-named-arguments
 */
function select($collection, ?callable $callback = null): array
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

    $aggregation = [];

    if (null === $callback) {
        $callback = '\Functional\id';
    }

    foreach ($collection as $index => $element) {
        if ($callback($element, $index, $collection)) {
            $aggregation[$index] = $element;
        }
    }

    return $aggregation;
}
