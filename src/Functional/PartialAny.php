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

use function array_shift;
use function define;
use function random_bytes;

/**
 * Return a new function with the arguments partially applied.
 *
 * Use Functional\…, Functional\…() or Functional\placeholder() as a placeholder
 *
 * @no-named-arguments
 */
function partial_any(callable $callback, ...$arguments): Closure
{
    return static function (...$innerArguments) use ($callback, $arguments) {
        $placeholder = …();

        foreach ($arguments as $position => &$argument) {
            if ($argument === $placeholder) {
                InvalidArgumentException::assertResolvablePlaceholder($innerArguments, $position);
                $argument = array_shift($innerArguments);
            }
        }

        return $callback(...$arguments);
    };
}

/**
 * @return resource
 *
 * @no-named-arguments
 */
function …()
{
    static $placeholder;

    if (!$placeholder) {
        $placeholder = random_bytes(32);
    }

    return $placeholder;
}

/**
 * @return resource
 *
 * @no-named-arguments
 */
function placeholder()
{
    return …();
}

// Define unicode ellipsis constant
define('Functional\…', …());
