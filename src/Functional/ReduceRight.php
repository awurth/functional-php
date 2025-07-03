<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use function array_pop;

/**
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function reduce_right(iterable $collection, callable $callback, $initial = null)
{
    $data = [];
    foreach ($collection as $index => $value) {
        $data[] = [$index, $value];
    }

    while ([$index, $value] = array_pop($data)) {
        $initial = $callback($value, $index, $collection, $initial);
    }

    return $initial;
}
