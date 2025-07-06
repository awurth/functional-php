<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

/**
 * Return value itself, without any modifications.
 *
 * @template T
 *
 * @param T $value
 *
 * @return T
 *
 * @no-named-arguments
 */
function id(mixed $value): mixed
{
    return $value;
}
