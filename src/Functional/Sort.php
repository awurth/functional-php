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

use function iterator_to_array;

/**
 * Sorts a collection with a user-defined function, optionally preserving array keys.
 *
 * @param iterable<mixed, mixed> $collection
 * @param bool                   $preserveKeys
 *
 * @return array
 *
 * @no-named-arguments
 */
function sort(iterable $collection, callable $callback, $preserveKeys = false)
{
    InvalidArgumentException::assertBoolean($preserveKeys, __FUNCTION__, 3);

    $array = $collection instanceof Traversable ? iterator_to_array($collection) : $collection;

    $fn = $preserveKeys ? 'uasort' : 'usort';

    $fn($array, static fn ($left, $right) => $callback($left, $right, $collection));

    return $array;
}
