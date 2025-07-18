<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use function is_callable;
use function trigger_error;

use const E_USER_DEPRECATED;

/**
 * Invoke a callback on a value if the value is not null.
 *
 * @param bool  $invokeValue Set to false to not invoke $value if it is a callable. Will be removed in 2.0
 * @param mixed $default     The default value to return if $value is null
 *
 * @no-named-arguments
 */
function with($value, callable $callback, bool $invokeValue = true, mixed $default = null)
{
    if (null === $value) {
        return $default;
    }

    if ($invokeValue && is_callable($value)) {
        @trigger_error('Invoking the value is deprecated and will be removed in 2.0', E_USER_DEPRECATED);

        $value = $value();
    }

    return $callback($value);
}
