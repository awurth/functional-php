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

use function array_flip;
use function array_intersect_key;
use function iterator_to_array;

/**
 * Select the specified keys from the array.
 *
 * @template TKey
 * @template TValue
 *
 * @param iterable<TKey, TValue> $collection
 * @param array<mixed, TKey>     $keys
 *
 * @return array<TKey, TValue>
 *
 * @no-named-arguments
 */
function select_keys(iterable $collection, array $keys): array
{
    $array = $collection instanceof Traversable ? iterator_to_array($collection) : $collection;

    return array_intersect_key($array, array_flip($keys));
}
