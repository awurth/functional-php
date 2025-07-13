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
 * @template TKey
 * @template TValue
 *
 * @param iterable<TKey, TValue>                                            $collection
 * @param callable(TValue, TKey, iterable<TKey, TValue>): (int|string|null) $callback
 *
 * @return array<int|string|null, array<TKey, TValue>>
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
