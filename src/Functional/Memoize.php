<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use function array_key_exists;
use function array_merge;
use function is_callable;
use function trigger_error;

use const E_USER_DEPRECATED;

/**
 * Memoizes callbacks and returns their value instead of calling them.
 *
 * @param callable|null $callback  Callable closure or function. Pass null to reset memory
 * @param array         $arguments Arguments
 * @param array|string  $key       Optional memoize key to override the auto calculated hash
 *
 * @no-named-arguments
 */
function memoize(?callable $callback = null, $arguments = [], $key = null)
{
    static $storage = [];
    if (null === $callback) {
        $storage = [];

        return null;
    }

    if (is_callable($key)) {
        @trigger_error('Passing a callable as key is deprecated and will be removed in 2.0', E_USER_DEPRECATED);
        $key = $key();
    } elseif (is_callable($arguments)) {
        @trigger_error('Passing a callable as key is deprecated and will be removed in 2.0', E_USER_DEPRECATED);
        $key = $arguments();
    }

    $key = null === $key ? value_to_key(array_merge([$callback], $arguments)) : value_to_key($key);

    if (!isset($storage[$key]) && !array_key_exists($key, $storage)) {
        $storage[$key] = $callback(...$arguments);
    }

    return $storage[$key];
}
