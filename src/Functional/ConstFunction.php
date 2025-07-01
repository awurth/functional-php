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
 * Wrap value within a function, which will return it, without any modifications.
 *
 * @return callable
 *
 * @no-named-arguments
 */
function const_function($value)
{
    return static fn() => $value;
}
