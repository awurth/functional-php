<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use Exception;

use function Functional\with;

class WithTest extends AbstractTestCase
{
    public function testWithNull(): void
    {
        self::assertNull(
            with(null, static function (): void {
                throw new Exception('Should not be called');
            }),
        );
    }

    public function testWithValue(): void
    {
        self::assertSame(
            2,
            with(
                1,
                static fn ($value) => $value + 1,
            ),
        );
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\with', 2);
        with(null, 'undefinedFunction');
    }

    public function testDefaultValue(): void
    {
        self::assertSame(
            'foo',
            with(
                null,
                static function (): void {
                },
                false,
                'foo',
            ),
        );
    }
}
