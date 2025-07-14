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
use PHPUnit\Framework\MockObject\MockObject;

use function count;
use function Functional\each;

interface Cb
{
    public function call(mixed $value, mixed $key, iterable $collection): void;
}

final class EachTest extends AbstractTestCase
{
    private MockObject&Cb $cb;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cb = $this->createMock(Cb::class);

        $this->list = ['value0', 'value1', 'value2', 'value3'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = ['k0' => 'value0', 'k1' => 'value1', 'k2' => 'value2'];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    public function testArray(): void
    {
        $this->prepareCallback($this->list);

        each($this->list, [$this->cb, 'call']);
    }

    public function testIterator(): void
    {
        $this->prepareCallback($this->listIterator);

        each($this->listIterator, [$this->cb, 'call']);
    }

    public function testHash(): void
    {
        $this->prepareCallback($this->hash);

        each($this->hash, [$this->cb, 'call']);
    }

    public function testHashIterator(): void
    {
        $this->prepareCallback($this->hashIterator);

        each($this->hashIterator, [$this->cb, 'call']);
    }

    public function testExceptionIsThrownInArray(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');

        each($this->list, $this->exception(...));
    }

    public function testExceptionIsThrownInCollection(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');

        each($this->listIterator, $this->exception(...));
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\each', 2);

        each($this->list, 'undefinedFunction');
    }

    private function prepareCallback($collection): void
    {
        $args = [];
        foreach ($collection as $key => $value) {
            $args[] = [$value, $key, $collection];
        }

        $invokedCount = self::exactly(count($args));
        $this->cb->expects($invokedCount)
            ->method('call')
            ->willReturnCallback(static function ($value, $key, $collection) use ($args, $invokedCount): void {
                self::assertSame($args[$invokedCount->numberOfInvocations() - 1], [$value, $key, $collection]);
            })
        ;
    }
}
