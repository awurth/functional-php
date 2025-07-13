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
use ErrorException;

use function restore_error_handler;
use function set_error_handler;

/**
 * Takes a function and returns a new function that wraps the callback and suppresses the PHP error.
 *
 * @throws ErrorException Throws exception if PHP error happened
 *
 * @no-named-arguments
 */
function suppress_error(callable $callback): Closure
{
    return static function (...$arguments) use ($callback) {
        try {
            set_error_handler(const_function(null));

            return $callback(...$arguments);
        } finally {
            restore_error_handler();
        }
    };
}
