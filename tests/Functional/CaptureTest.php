<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use function Functional\capture;

class CaptureTest extends AbstractTestCase
{
    public function testCaptureReturnValue(): void
    {
        $fn = capture(
            static fn (...$args) => $args,
            $result,
        );

        self::assertSame([1, 2], $fn(1, 2));
        self::assertSame([1, 2], $result);
    }
}
