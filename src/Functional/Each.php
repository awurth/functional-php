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

/**
 * Iterates over a collection of elements, yielding each in turn to a callback function. Each invocation of $callback
 * is called with three arguments: (element, index, collection).
 *
 * @param array|Traversable $collection
 *
 * @no-named-arguments
 */
function each($collection, callable $callback): void
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

    foreach ($collection as $index => $element) {
        $callback($element, $index, $collection);
    }
}
