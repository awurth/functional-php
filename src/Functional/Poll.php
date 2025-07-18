<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use AppendIterator;
use ArrayIterator;
use Functional\Exceptions\InvalidArgumentException;
use InfiniteIterator;
use Iterator;

use function microtime;
use function usleep;

/**
 * Retry a callback until it returns a truthy value or the timeout (in microseconds) is reached.
 *
 * @param int           $timeout       Timeout in microseconds
 * @param Iterator|null $delaySequence Default: no delay between calls
 *
 * @throws InvalidArgumentException
 *
 * @no-named-arguments
 */
function poll(callable $callback, int $timeout, ?Iterator $delaySequence = null): bool
{
    InvalidArgumentException::assertIntegerGreaterThanOrEqual($timeout, 0, __FUNCTION__, 2);

    $retry = 0;

    $delays = new AppendIterator();
    if ($delaySequence instanceof Iterator) {
        $delays->append(new InfiniteIterator($delaySequence));
    }
    $delays->append(new InfiniteIterator(new ArrayIterator([0])));

    $limit = microtime(true) + ($timeout / 100000);

    foreach ($delays as $delay) {
        $value = $callback($retry, $delay);

        if (true === $value) {
            return true;
        }

        if (microtime(true) > $limit) {
            return false;
        }

        if ($delay > 0) {
            usleep($delay);
        }

        ++$retry;
    }

    return false;
}
