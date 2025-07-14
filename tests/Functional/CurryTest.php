<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use Override;

use function Functional\curry;

class CurryTest extends CurryNTest
{
    #[Override]
    protected function getCurryiedCallable(callable $callback, array $params, bool $required): callable
    {
        return curry($callback, $required);
    }
}
