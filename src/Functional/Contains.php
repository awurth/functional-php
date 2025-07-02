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
 * Returns true if the collection contains the given value.
 *
 * @param array|Traversable $collection
 *
 * @no-named-arguments
 */
function contains($collection, mixed $value): bool
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

    foreach ($collection as $element) {
        if ($value === $element) {
            return true;
        }
    }

    return false;
}
