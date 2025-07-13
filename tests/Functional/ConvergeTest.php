<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use function Functional\converge;

class ConvergeTest extends AbstractTestCase
{
    public function testCallablesAsStrings(): void
    {
        $average = converge(static fn ($dividend, $divisor): int|float => $dividend / $divisor, ['array_sum', 'count']);
        self::assertEquals(2.5, $average([1, 2, 3, 4]));
    }

    public function testCallablesAsAnonymous(): void
    {
        $strangeFunction = converge(
            static fn ($u, $l): string => $u.$l,
            [
                'strtoupper',
                'strtolower',
            ],
        );

        self::assertSame(
            'FUNCTIONAL PROGRAMMINGfunctional programming',
            $strangeFunction('Functional Programming'),
        );
    }
}
