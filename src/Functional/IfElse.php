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
 * Performs an if/else condition over a value using functions as statements.
 *
 * @param callable $if   the condition function
 * @param callable $then function to call if condition is true
 * @param callable $else function to call if condition is false
 *
 * @return mixed the return value of the given $then or $else functions
 *
 * @no-named-arguments
 */
function if_else(callable $if, callable $then, callable $else)
{
    return static fn ($value) => $if($value) ? $then($value) : $else($value);
}
