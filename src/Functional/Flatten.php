<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Traversable;

use function array_shift;
use function array_unshift;
use function is_array;

/**
 * Takes a nested combination of collections and returns their contents as a single, flat array.
 * Does not preserve indexes.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function flatten(iterable $collection): array
{
    $stack = [$collection];
    $result = [];

    while ([] !== $stack) {
        $item = array_shift($stack);

        if (is_array($item) || $item instanceof Traversable) {
            foreach ($item as $element) {
                array_unshift($stack, $element);
            }
        } else {
            array_unshift($result, $item);
        }
    }

    return $result;
}
