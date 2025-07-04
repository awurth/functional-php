<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use function Functional\sequence_constant;

class SequenceConstantTest extends AbstractTestCase
{
    public function testConstantIncrements(): void
    {
        $sequence = sequence_constant(1);

        $values = $this->sequenceToArray($sequence, 10);

        self::assertSame([1, 1, 1, 1, 1, 1, 1, 1, 1, 1], $values);
    }

    public function testArgumentMustBePositiveInteger(): void
    {
        $this->expectArgumentError(
            'Functional\sequence_constant() expects parameter 1 to be an integer greater than or equal to 0',
        );
        sequence_constant(-1);
    }
}
