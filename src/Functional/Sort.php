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
 * @param array|Traversable $collection
 * @param bool              $preserveKeys
 *
 * @return array
 *
 * @no-named-arguments
 */
function sort($collection, callable $callback, $preserveKeys = false)
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);
    InvalidArgumentException::assertBoolean($preserveKeys, __FUNCTION__, 3);

    if ($collection instanceof Traversable) {
        $array = iterator_to_array($collection);
    } else {
        $array = $collection;
    }

    $fn = $preserveKeys ? 'uasort' : 'usort';

    $fn($array, static function ($left, $right) use ($callback, $collection) {
        return $callback($left, $right, $collection);
    });

    return $array;
}
