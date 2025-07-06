<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use ArrayAccess;
use Functional\Exceptions\InvalidArgumentException;

use function is_array;
use function is_object;

/**
 * Extract a property from a collection of objects.
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function pluck(iterable $collection, string $propertyName): array
{
    InvalidArgumentException::assertPropertyName($propertyName, __FUNCTION__, 2);

    $aggregation = [];

    foreach ($collection as $index => $element) {
        $value = null;

        if (is_object($element) && isset($element->{$propertyName})) {
            $value = $element->{$propertyName};
        } elseif ((is_array($element) || $element instanceof ArrayAccess) && isset($element[$propertyName])) {
            $value = $element[$propertyName];
        }

        $aggregation[$index] = $value;
    }

    return $aggregation;
}
