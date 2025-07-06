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

use function array_slice;
use function is_array;
use function iterator_to_array;

/**
 * Creates a slice of $collection with $count elements taken from the end. If the collection has less than $count
 * elements, the whole collection will be returned as an array.
 * This function will reorder and reset the integer array indices by default. This behaviour can be changed by setting
 * preserveKeys to TRUE. String keys are always preserved, regardless of this parameter.
 *
 * @template TKey
 * @template TValue
 *
 * @param iterable<TKey, TValue> $collection
 *
 * @return array<TKey, TValue>
 *
 * @no-named-arguments
 */
function take_right(iterable $collection, int $count, bool $preserveKeys = false): array
{
    InvalidArgumentException::assertPositiveInteger($count, __FUNCTION__, 2);

    return array_slice(
        is_array($collection) ? $collection : iterator_to_array($collection),
        0 - $count,
        $count,
        $preserveKeys,
    );
}
