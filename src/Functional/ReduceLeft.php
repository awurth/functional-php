<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

/**
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function reduce_left(iterable $collection, callable $callback, mixed $initial = null): mixed
{
    foreach ($collection as $index => $value) {
        $initial = $callback($value, $index, $collection, $initial);
    }

    return $initial;
}
