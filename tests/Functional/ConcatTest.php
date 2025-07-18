<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use function Functional\concat;

final class ConcatTest extends AbstractTestCase
{
    public function test(): void
    {
        self::assertSame('foobar', concat('foo', 'bar'));
        self::assertSame('foobarbaz', concat('foo', 'bar', 'baz'));
        self::assertSame('', concat());
    }
}
