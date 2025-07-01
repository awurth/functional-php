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

use function array_pop;
use function end;
use function is_callable;
use function reset;

/**
 * Recombines arrays by index and applies a callback optionally.
 *
 * @param array|Traversable ...$args One or more callbacks
 *
 * @no-named-arguments
 */
function zip(...$args): array
{
    $callback = null;
    if (is_callable(end($args))) {
        $callback = array_pop($args);
    }

    foreach ($args as $position => $arg) {
        InvalidArgumentException::assertCollection($arg, __FUNCTION__, $position + 1);
    }

    $result = [];
    foreach ((array) reset($args) as $index => $value) {
        $zipped = [];

        foreach ($args as $arg) {
            $zipped[] = $arg[$index] ?? null;
        }

        if (null !== $callback) {
            /** @var callable $callback */
            $zipped = $callback(...$zipped);
        }

        $result[$index] = $zipped;
    }

    return $result;
}
