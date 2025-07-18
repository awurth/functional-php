<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests\Exceptions;

use ArrayObject;
use Functional\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

class InvalidArgumentExceptionTest extends TestCase
{
    public function testExceptionIfStringIsPassedAsList(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('func() expects parameter 4 to be array or instance of Traversable, string given');

        InvalidArgumentException::assertCollection('string', 'func', 4);
    }

    public function testExceptionIfObjectIsPassedAsList(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('func() expects parameter 2 to be array or instance of Traversable, stdClass given');

        InvalidArgumentException::assertCollection(new stdClass(), 'func', 2);
    }

    public function testAssertArrayAccessValidCase(): void
    {
        $validObject = new ArrayObject();

        InvalidArgumentException::assertArrayAccess($validObject, 'func', 4);
        $this->addToAssertionCount(1);
    }

    public function testAssertArrayAccessWithString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('func() expects parameter 4 to be array or instance of ArrayAccess, string given');
        InvalidArgumentException::assertArrayAccess('string', 'func', 4);
    }

    public function testAssertArrayAccessWithStandardClass(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('func() expects parameter 2 to be array or instance of ArrayAccess, stdClass given');
        InvalidArgumentException::assertArrayAccess(new stdClass(), 'func', 2);
    }

    public function testExceptionIfInvalidPropertyName(): void
    {
        InvalidArgumentException::assertPropertyName('property', 'func', 2);
        InvalidArgumentException::assertPropertyName(0, 'func', 2);
        InvalidArgumentException::assertPropertyName(0.2, 'func', 2);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('func() expects parameter 2 to be a valid property name or array index, stdClass given');
        InvalidArgumentException::assertPropertyName(new stdClass(), 'func', 2);
    }

    public function testNoExceptionThrownWithPositiveInteger(): void
    {
        $this->expectNotToPerformAssertions();
        InvalidArgumentException::assertPositiveInteger('2', 'foo', 1);
        InvalidArgumentException::assertPositiveInteger(2, 'foo', 1);
    }

    public function testExceptionIfNegativeIntegerInsteadOfPositiveInteger(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('func() expects parameter 2 to be positive integer, negative integer given');
        InvalidArgumentException::assertPositiveInteger(-1, 'func', 2);
    }

    public function testExceptionIfStringInsteadOfPositiveInteger(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('func() expects parameter 2 to be positive integer, string given');
        InvalidArgumentException::assertPositiveInteger('str', 'func', 2);
    }

    public function testAssertPairWithPair(): void
    {
        $this->expectNotToPerformAssertions();
        InvalidArgumentException::assertPair([1, 2], 'func', 1);
        InvalidArgumentException::assertPair(['1', 2], 'func', 1);
        InvalidArgumentException::assertPair([1, '2'], 'func', 1);
        InvalidArgumentException::assertPair([new stdClass(), '2'], 'func', 1);
    }

    public function testAssertPairWithEmptyArray(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('func() expects parameter 1 to be a pair (array with two elements)');
        InvalidArgumentException::assertPair([], 'func', 1);
    }

    public function testAssertPairWithInvalidArray(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('func() expects parameter 1 to be a pair (array with two elements)');
        InvalidArgumentException::assertPair(['one'], 'func', 1);
    }

    public function testAssertPairWithTwoCharacterString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('func() expects parameter 1 to be a pair (array with two elements)');
        InvalidArgumentException::assertPair('ab', 'func', 1);
    }

    public function testAssertPairWithThreeCharacterString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('func() expects parameter 1 to be a pair (array with two elements)');
        InvalidArgumentException::assertPair('abc', 'func', 1);
    }
}
