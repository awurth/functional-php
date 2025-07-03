<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Traversable;

use function is_array;

/**
 * flat_map works applying a function (callback) that returns a sequence for each element in a collection,
 * and flattening the results into the resulting array.
 *
 * flat_map(...) differs from flatten(map(...)) because it only flattens one level of nesting,
 * whereas flatten will recursively flatten nested collections.
 *
 * For example if map(collection, callback) returns [[],1,[2,3],[[4]]]
 * then flat_map(collection, callback) will return [1,2,3,[4]]
 * while flatten(map(collection, callback)) will return [1,2,3,4]
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function flat_map(iterable $collection, callable $callback): array
{
    $flattened = [];

    foreach ($collection as $index => $element) {
        $result = $callback($element, $index, $collection);

        if (is_array($result) || $result instanceof Traversable) {
            foreach ($result as $item) {
                $flattened[] = $item;
            }
        } elseif (null !== $result) {
            $flattened[] = $result;
        }
    }

    return $flattened;
}
