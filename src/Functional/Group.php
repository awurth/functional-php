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

/**
 * Groups a collection by index returned by callback.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function group(iterable $collection, callable $callback): array
{
    $groups = [];

    foreach ($collection as $index => $element) {
        $groupKey = $callback($element, $index, $collection);

        InvalidArgumentException::assertValidArrayKey($groupKey, __FUNCTION__);

        if (!isset($groups[$groupKey])) {
            $groups[$groupKey] = [];
        }

        $groups[$groupKey][$index] = $element;
    }

    return $groups;
}
