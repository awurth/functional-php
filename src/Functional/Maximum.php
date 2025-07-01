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

use function is_numeric;

/**
 * Returns the maximum value of a collection.
 *
 * @param array|Traversable $collection
 *
 * @return float|int
 *
 * @no-named-arguments
 */
function maximum($collection)
{
    InvalidArgumentException::assertCollection($collection, __FUNCTION__, 1);

    $max = null;

    foreach ($collection as $element) {
        if (!is_numeric($element)) {
            continue;
        }

        if ($element > $max || null === $max) {
            $max = $element;
        }
    }

    return $max;
}
