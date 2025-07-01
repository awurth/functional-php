<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use ArrayAccess;
use Functional\Exceptions\InvalidArgumentException;

use function array_key_exists;
use function is_array;

/**
 * Pick a single element from a collection of objects or arrays by index.
 * If no such index exists, return the default value.
 *
 * @param array|ArrayAccess $collection
 * @param mixed             $index
 * @param mixed             $default
 * @param null|callable     $callback   Custom function to check if index exists
 *
 * @return mixed
 *
 * @no-named-arguments
 */
function pick($collection, $index, $default = null, ?callable $callback = null)
{
    InvalidArgumentException::assertArrayAccess($collection, __FUNCTION__, 1);

    if (null === $callback) {
        if (!isset($collection[$index]) && (!is_array($collection) || !array_key_exists($index, $collection))) {
            return $default;
        }
    } else {
        if (!$callback($collection, $index)) {
            return $default;
        }
    }

    return $collection[$index];
}
