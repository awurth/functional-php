<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use ArrayIterator;
use stdClass;

use function Functional\minimum;

class MinimumTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->list = [1, 'foo', 5.1, 5, '5.2', true, false, [], new stdClass()];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = [
            'k1' => 1,
            'k2' => '5.2',
            'k3' => 5,
            'k4' => '5.1',
            'k5' => 10.2,
            'k6' => true,
            'k7' => [],
            'k8' => new stdClass(),
            'k9' => -10,
        ];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    public function testExtractingMinimumValue(): void
    {
        self::assertEquals(1, minimum($this->list));
        self::assertEquals(1, minimum($this->listIterator));
        self::assertEquals(-10, minimum($this->hash));
        self::assertEquals(-10, minimum($this->hashIterator));
    }

    public function testSpecialCaseNull(): void
    {
        self::assertSame(-1, minimum([-1]));
    }

    public function testSpecialCaseSameValueDifferentTypes(): void
    {
        self::assertSame(0, minimum([0, 1, 0.0, 1.0, '0', '1', '0.0', '1.0']));
    }
}
