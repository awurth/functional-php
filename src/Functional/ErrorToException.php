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
 * Takes a function and returns a new function that wraps the callback and rethrows PHP errors as exception.
 *
 * @throws ErrorException Throws exception if PHP error happened
 *
 * @no-named-arguments
 *
 * @phpstan-ignore throws.unusedType
 */
function error_to_exception(callable $callback): Closure
{
    return static function (...$arguments) use ($callback) {
        try {
            set_error_handler(
                static function ($level, $message, $file, $line): void {
                    throw new ErrorException($message, 0, $level, $file, $line);
                },
            );

            return $callback(...$arguments);
        } finally {
            restore_error_handler();
        }
    };
}
