<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use stdClass;

use function Functional\tap;

final class TapTest extends AbstractTestCase
{
    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\tap', 2);
        tap('foo', 'undefinedFunction');
    }

    public function testTap(): void
    {
        $input = new stdClass();
        $input->property = 'foo';

        $output = tap($input, static function ($o): void {
            $o->property = 'bar';
        });

        self::assertSame($input, $output);
        self::assertSame('bar', $input->property);
    }
}
