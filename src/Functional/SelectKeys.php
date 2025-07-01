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

use function array_flip;
use function array_intersect_key;
use function iterator_to_array;

/**
 * Select the specified keys from the array.
 *
 * @param array|Traversable $collection
 *
 * @no-named-arguments
 */
function select_keys($collection, array $keys): array
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

    $array = $collection instanceof Traversable ? iterator_to_array($collection) : $collection;

    return array_intersect_key($array, array_flip($keys));
}
