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
 * Alias of Functional\select().
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function filter(iterable $collection, callable $callback): array
{
    return select($collection, $callback);
}
