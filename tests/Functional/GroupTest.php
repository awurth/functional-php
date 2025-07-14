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
use Exception;
use stdClass;

use function Functional\group;
use function is_int;
use function sprintf;
use function stream_context_create;

class GroupTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->list = ['value1', 'value2', 'value3', 'value4'];
        $this->listIterator = new ArrayIterator($this->list);
        $this->hash = ['k1' => 'val1', 'k2' => 'val2', 'k3' => 'val3'];
        $this->hashIterator = new ArrayIterator($this->hash);
    }

    public function test(): void
    {
        $fn = static function ($v, $k, iterable $collection) {
            return (is_int($k) ? ($k % 2 == 0) : ($v[3] % 2 == 0)) ? 'foo' : '';
        };
        self::assertSame(['foo' => [0 => 'value1', 2 => 'value3'], '' => [1 => 'value2', 3 => 'value4']], group($this->list, $fn));
        self::assertSame(['foo' => [0 => 'value1', 2 => 'value3'], '' => [1 => 'value2', 3 => 'value4']], group($this->listIterator, $fn));
        self::assertSame(['' => ['k1' => 'val1', 'k3' => 'val3'], 'foo' => ['k2' => 'val2']], group($this->hash, $fn));
        self::assertSame(['' => ['k1' => 'val1', 'k3' => 'val3'], 'foo' => ['k2' => 'val2']], group($this->hashIterator, $fn));
    }

    public function testExceptionIsThrownWhenCallbacksReturnsInvalidKey(): void
    {
        $array = ['v1', 'v2', 'v3', 'v4'];
        $keyMap = [1, -1, 'str', null];
        $fn = static function ($v, $k, $collection) use (&$keyMap) {
            return $keyMap[$k];
        };
        $result = [
            1 => [0 => 'v1'],
            -1 => [1 => 'v2'],
            'str' => [2 => 'v3'],
            null => [3 => 'v4'],
        ];
        self::assertSame($result, group($array, $fn));
        self::assertSame($result, group(new ArrayIterator($array), $fn));

        $invalidTypes = [
            'resource (stream-context)' => stream_context_create(),
            'stdClass' => new stdClass(),
            'array' => [],
            'bool' => true,
            'float' => 1.1,
        ];

        foreach ($invalidTypes as $type => $value) {
            $keyMap = [$value];
            try {
                group(['v1'], $fn);
                self::fail(sprintf('Error expected for array key type "%s"', $type));
            } catch (Exception $e) {
                self::assertSame(
                    sprintf(
                        'Functional\group(): callback returned invalid array key of type "%s". Expected null, string or int',
                        $type,
                    ),
                    $e->getMessage(),
                );
            }
        }
    }

    public function testExceptionIsThrownInArray(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        group($this->list, $this->exception(...));
    }

    public function testExceptionIsThrownInHash(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        group($this->hash, $this->exception(...));
    }

    public function testExceptionIsThrownInIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        group($this->listIterator, $this->exception(...));
    }

    public function testExceptionIsThrownInHashIterator(): void
    {
        $this->expectException('DomainException');
        $this->expectExceptionMessage('Callback exception');
        group($this->hashIterator, $this->exception(...));
    }

    public function testPassNonCallable(): void
    {
        $this->expectCallableArgumentError('Functional\group', 2);
        group($this->list, 'undefinedFunction');
    }
}
