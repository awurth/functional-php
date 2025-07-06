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

use function iterator_to_array;

/**
 * Sorts a collection with a user-defined function, optionally preserving array keys.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function sort(iterable $collection, callable $callback, bool $preserveKeys = false): array
{
    $array = $collection instanceof Traversable ? iterator_to_array($collection) : $collection;

    $fn = $preserveKeys ? 'uasort' : 'usort';

    $fn($array, static fn ($left, $right) => $callback($left, $right, $collection));

    return $array;
}
