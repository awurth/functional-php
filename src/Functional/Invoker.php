<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Functional\Exceptions\InvalidArgumentException;

/**
 * Returns a function that invokes method `$method` with arguments `$methodArguments` on the object.
 *
 * @param string $methodName
 *
 * @return callable
 *
 * @no-named-arguments
 */
function invoker($methodName, array $arguments = [])
{
    InvalidArgumentException::assertMethodName($methodName, __FUNCTION__, 1);

    return static fn ($object) => $object->{$methodName}(...$arguments);
}
