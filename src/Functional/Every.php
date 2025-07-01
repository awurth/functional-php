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
 * Returns true if every value in the collection passes the callback truthy test. Opposite of Functional\none().
 * Callback arguments will be element, index, collection.
 *
 * @param array|Traversable $collection
 *
 * @return bool
 *
 * @no-named-arguments
 */
function every($collection, ?callable $callback = null)
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

    if (null === $callback) {
        $callback = '\Functional\id';
    }

    foreach ($collection as $index => $element) {
        if (!$callback($element, $index, $collection)) {
            return false;
        }
    }

    return true;
}
