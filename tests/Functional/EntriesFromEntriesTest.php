<?php

/**
 * @author    Hugo Sales <hugo@hsal.es>
 * @copyright 2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use ArrayIterator;

use function array_keys;
use function count;
use function Functional\entries;
use function Functional\from_entries;
use function range;

class EntriesFromEntriesTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->list = ['value0', 'value1', 'value2', 'value3'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = ['k0' => 'value0', 'k1' => 'value1', 'k2' => 'value2', 'k3' => 'value3'];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    public function testArray(): void
    {
        $res = entries($this->list);
        self::assertSame(array_keys($res), range(0, count($this->list) - 1));
        self::assertSame(from_entries($res), $this->list);
    }

    public function testIterator(): void
    {
        $res = entries($this->listIterator);
        self::assertSame(array_keys($res), range(0, count($this->listIterator) - 1));
        self::assertSame(from_entries($res), $this->listIterator->getArrayCopy());
    }

    public function testHash(): void
    {
        $res = entries($this->hash);
        self::assertSame(array_keys($res), range(0, count($this->hash) - 1));
        self::assertSame(from_entries($res), $this->hash);
    }

    public function testHashIterator(): void
    {
        $res = entries($this->hashIterator);
        self::assertSame(array_keys($res), range(0, count($this->hashIterator) - 1));
        self::assertSame(from_entries($res), $this->hashIterator->getArrayCopy());
    }

    public function testHashWithStart(): void
    {
        $res = entries($this->hash, 42);
        self::assertSame(array_keys($res), range(42, 42 + count($this->hash) - 1));
        self::assertSame(from_entries($res), $this->hash);
    }
}
