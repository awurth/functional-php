<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Functional\Exceptions\MatchException;

/**
 * Performs an operation checking for the given conditions.
 *
 * @param array $conditions the conditions to check against
 *
 * @return callable|null the function that calls the callable of the first truthy condition
 *
 * @no-named-arguments
 */
function matching(array $conditions)
{
    MatchException::assert($conditions, __FUNCTION__);

    return static function ($value) use ($conditions) {
        if ([] === $conditions) {
            return null;
        }

        [$if, $then] = head($conditions);

        return if_else($if, $then, matching(tail($conditions)))($value);
    };
}
