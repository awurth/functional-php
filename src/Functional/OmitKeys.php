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

use function array_diff_key;
use function array_flip;
use function iterator_to_array;

/**
 * Returns an array with the specified keys omitted from the array.
 *
 * @param array|Traversable $collection
 *
 * @return array
 *
 * @no-named-arguments
 */
function omit_keys($collection, array $keys): array
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

    if ($collection instanceof Traversable) {
        $array = iterator_to_array($collection);
    } else {
        $array = $collection;
    }

    return array_diff_key($array, array_flip($keys));
}
