<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use ErrorException;
use RuntimeException;

use function Functional\error_to_exception;
use function restore_error_handler;
use function set_error_handler;
use function trigger_error;

final class ErrorToExceptionTest extends AbstractTestCase
{
    public function testErrorIsThrownAsException(): void
    {
        $origFn = static function (): void {
            trigger_error('Some error');
        };

        $fn = error_to_exception($origFn);

        $this->expectException(ErrorException::class);
        $this->expectExceptionMessage('Some error');

        $fn();
    }

    public function testFunctionIsWrapped(): void
    {
        $fn = error_to_exception('substr');

        self::assertSame('f', $fn('foo', 0, 1));
    }

    public function testExceptionsAreHandledTransparently(): void
    {
        $expectedException = new RuntimeException();
        $fn = error_to_exception(
            static function () use ($expectedException): void {
                throw $expectedException;
            },
        );

        $this->expectException(RuntimeException::class);

        $fn();
    }

    public function testErrorHandlerNestingWorks(): void
    {
        $errorMessage = null;
        set_error_handler(
            static function ($level, $message) use (&$errorMessage): void {
                $errorMessage = $message;
            },
        );

        $origFn = static function (): void {
            trigger_error('Some error');
        };

        $fn = error_to_exception($origFn);
        try {
            $fn();
            self::fail('ErrorException expected');
        } catch (ErrorException) {
            self::assertNull($errorMessage);
        }

        $origFn();
        self::assertSame('Some error', $errorMessage);
        restore_error_handler();
    }
}
