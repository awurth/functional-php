<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Exceptions;

use Countable;

use function count;
use function gettype;
use function is_array;
use function is_callable;
use function sprintf;

/** @internal */
class MatchException extends InvalidArgumentException
{
    /**
     * @param array<mixed, mixed> $conditions
     */
    public static function assert(array $conditions, string $callee): void
    {
        foreach ($conditions as $key => $condition) {
            static::assertArray($key, $condition, $callee);
            static::assertLength($key, $condition, $callee);
            static::assertCallables($key, $condition, $callee);
        }
    }

    private static function assertArray(int|string $key, mixed $condition, string $callee): void
    {
        if (!is_array($condition)) {
            throw new static(sprintf('%s() expects condition at key %d to be array, %s given', $callee, $key, gettype($condition)),);
        }
    }

    /**
     * @param array<mixed, mixed>|Countable $condition
     */
    private static function assertLength(int|string $key, array|Countable $condition, string $callee): void
    {
        if (count($condition) < 2) {
            throw new static(sprintf('%s() expects size of condition at key %d to be greater than or equals to 2, %d given', $callee, $key, count($condition)),);
        }
    }

    private static function assertCallables(int|string $key, $condition, string $callee): void
    {
        if (!is_callable($condition[0]) || !is_callable($condition[1])) {
            throw new static(sprintf('%s() expects first two items of condition at key %d to be callables', $callee, $key),);
        }
    }
}
