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
 * Returns true if all elements of the collection are strictly false.
 *
 * @param array|Traversable $collection
 *
 * @no-named-arguments
 */
function false($collection): bool
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

    foreach ($collection as $value) {
        if (false !== $value) {
            return false;
        }
    }

    return true;
}
