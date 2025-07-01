<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Closure;
use Functional\Exceptions\InvalidArgumentException;

/**
 * Creates a function that can be used to repeat the execution of $callback.
 *
 * @return Closure
 *
 * @no-named-arguments
 */
function repeat(callable $callback)
{
    return function ($times) use ($callback): void {
        InvalidArgumentException::assertPositiveInteger($times, __FUNCTION__, 1);

        for ($i = 0; $i < $times; ++$i) {
            $callback();
        }
    };
}
