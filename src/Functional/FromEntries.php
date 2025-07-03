<?php

/**
 * @author    Hugo Sales <hugo@hsal.es>
 * @copyright 2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Functional\Exceptions\InvalidArgumentException;

/**
 * Inspired by JavaScript’s `Object.fromEntries`,
 * convert an array of key-value pairs into a key-value map.
 *
 * @see entries
 *
 * @param iterable<mixed, mixed> $collection
 *
 * @no-named-arguments
 */
function from_entries(iterable $collection): array
{
    $aggregation = [];
    foreach ($collection as $entry) {
        InvalidArgumentException::assertPair($entry, __FUNCTION__, 1);
        [$key, $value] = $entry;
        InvalidArgumentException::assertValidArrayKey($key, __FUNCTION__);
        $aggregation[$key] = $value;
    }

    return $aggregation;
}
