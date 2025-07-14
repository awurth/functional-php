<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use function Functional\invoker;

final class InvokerTest extends AbstractTestCase
{
    public function testInvokerWithoutArguments(): void
    {
        $fn = invoker('valueMethod');
        self::assertSame('value', $fn($this));
    }

    public function testInvokerWithArguments(): void
    {
        $arguments = [1, 2, 3];
        $fn = invoker('argumentMethod', $arguments);
        self::assertSame($arguments, $fn($this));
    }

    public function testInvalidMethod(): void
    {
        $fn = invoker('undefinedMethod');

        $this->expectException('Error');
        $this->expectExceptionMessage('Call to undefined method Functional\Tests\InvokerTest::undefinedMethod');

        $fn($this);
    }

    public function valueMethod(...$arguments): string
    {
        self::assertEmpty($arguments);

        return 'value';
    }

    public function argumentMethod(...$arguments)
    {
        self::assertNotEmpty($arguments);

        return $arguments;
    }
}
