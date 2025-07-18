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

use function func_get_args;
use function Functional\invoke_first;

final class InvokeFirstTest extends AbstractTestCase
{
    private array $keyArray;

    private ArrayIterator $keyIterator;

    private array $arrayVeryFirstNotCallable;

    private ArrayIterator $iteratorVeryFirstNotCallable;

    protected function setUp(): void
    {
        parent::setUp();

        $this->list = [$this, null, null];
        $this->listIterator = new ArrayIterator($this->list);
        $this->keyArray = ['k1' => $this, 'k2' => null];
        $this->keyIterator = new ArrayIterator(['k1' => $this, 'k2' => null]);

        $this->arrayVeryFirstNotCallable = [null, $this, null, null];
        $this->iteratorVeryFirstNotCallable = new ArrayIterator($this->arrayVeryFirstNotCallable);
    }

    public function testSimple(): void
    {
        self::assertSame('methodValue', invoke_first($this->list, 'method', [1, 2]));
        self::assertSame('methodValue', invoke_first($this->listIterator, 'method'));
        self::assertNull(invoke_first($this->list, 'undefinedMethod'));
        self::assertNull(invoke_first($this->list, 'setExpectedExceptionFromAnnotation'), 'Protected method');
        self::assertSame([1, 2], invoke_first($this->list, 'returnArguments', [1, 2]));
        self::assertSame('methodValue', invoke_first($this->keyArray, 'method'));
        self::assertSame('methodValue', invoke_first($this->keyIterator, 'method'));
    }

    public function testSkipNonCallables(): void
    {
        self::assertSame('methodValue', invoke_first($this->arrayVeryFirstNotCallable, 'method', [1, 2]));
        self::assertSame('methodValue', invoke_first($this->iteratorVeryFirstNotCallable, 'method'));
        self::assertNull(invoke_first($this->arrayVeryFirstNotCallable, 'undefinedMethod'));
        self::assertNull(
            invoke_first($this->arrayVeryFirstNotCallable, 'setExpectedExceptionFromAnnotation'),
            'Protected method',
        );
        self::assertSame([1, 2], invoke_first($this->arrayVeryFirstNotCallable, 'returnArguments', [1, 2]));
    }

    public function testException(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        invoke_first($this->list, 'exception');
    }

    public function method(): string
    {
        return 'methodValue';
    }

    public function returnArguments(): array
    {
        return func_get_args();
    }
}
