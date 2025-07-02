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
use function is_array;
use function iterator_to_array;

/**
 * Returns an array containing the elements of the list without its last element.
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
function but_last(iterable $collection): array
{
    $butLast = is_array($collection) ? $collection : iterator_to_array($collection);
    array_pop($butLast);

    return $butLast;
}
