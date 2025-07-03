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

use function array_diff_key;
use function array_flip;
use function iterator_to_array;

/**
 * Returns an array with the specified keys omitted from the array.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function omit_keys(iterable $collection, array $keys): array
{
    $array = $collection instanceof Traversable ? iterator_to_array($collection) : $collection;

    return array_diff_key($array, array_flip($keys));
}
