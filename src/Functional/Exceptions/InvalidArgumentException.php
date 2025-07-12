<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Exceptions;

use ArrayAccess;
use Throwable;

use function array_pop;
use function count;
use function gettype;
use function implode;
use function in_array;
use function is_array;
use function is_float;
use function is_int;
use function is_object;
use function is_string;
use function sprintf;

/** @internal */
class InvalidArgumentException extends \InvalidArgumentException
{
    final public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function assertCollection(mixed $collection, string $callee, int $parameterPosition): void
    {
        self::assertCollectionAlike($collection, 'Traversable', $callee, $parameterPosition);
    }

    public static function assertArrayAccess(mixed $collection, string $callee, int $parameterPosition): void
    {
        self::assertCollectionAlike($collection, 'ArrayAccess', $callee, $parameterPosition);
    }

    /**
     * @throws static
     */
    public static function assertPropertyName(mixed $propertyName, string $callee, int $parameterPosition): void
    {
        if (
            !is_string($propertyName)
            && !is_int($propertyName)
            && !is_float($propertyName)
            && null !== $propertyName
        ) {
            throw new static(sprintf('%s() expects parameter %d to be a valid property name or array index, %s given', $callee, $parameterPosition, self::getType($propertyName)),);
        }
    }

    public static function assertPositiveInteger(mixed $value, string $callee, int $parameterPosition): void
    {
        if ((string) (int) $value !== (string) $value || $value < 0) {
            $type = self::getType($value);
            $type = 'integer' === $type ? 'negative integer' : $type;

            throw new static(sprintf('%s() expects parameter %d to be positive integer, %s given', $callee, $parameterPosition, $type),);
        }
    }

    /**
     * @throws static
     */
    public static function assertValidArrayKey(mixed $key, string $callee): void
    {
        $keyTypes = ['NULL', 'string', 'integer'];

        $keyType = gettype($key);

        if (!in_array($keyType, $keyTypes, true)) {
            throw new static(sprintf('%s(): callback returned invalid array key of type "%s". Expected %4$s or %3$s', $callee, $keyType, array_pop($keyTypes), implode(', ', $keyTypes)),);
        }
    }

    /**
     * @throws static
     */
    public static function assertIntegerGreaterThanOrEqual(mixed $value, int $limit, string $callee, int $parameterPosition): void
    {
        if (!is_int($value) || $value < $limit) {
            throw new static(sprintf('%s() expects parameter %d to be an integer greater than or equal to %d', $callee, $parameterPosition, $limit),);
        }
    }

    /**
     * @throws static
     */
    public static function assertIntegerLessThanOrEqual(mixed $value, int $limit, string $callee, int $parameterPosition): void
    {
        if (!is_int($value) || $value > $limit) {
            throw new static(sprintf('%s() expects parameter %d to be an integer less than or equal to %d', $callee, $parameterPosition, $limit),);
        }
    }

    /**
     * @param array<mixed, mixed> $args
     */
    public static function assertResolvablePlaceholder(array $args, int $position): void
    {
        if (count($args) === 0) {
            throw new static(sprintf('Cannot resolve parameter placeholder at position %d. Parameter stack is empty.', $position),);
        }
    }

    public static function assertNonZeroInteger(mixed $value, string $callee): void
    {
        if (!is_int($value) || 0 === $value) {
            throw new static(sprintf('%s expected parameter %d to be non-zero', $callee, $value));
        }
    }

    public static function assertPair(mixed $pair, string $callee, int $position): void
    {
        if (!(is_array($pair) || $pair instanceof ArrayAccess) || !isset($pair[0], $pair[1])) {
            throw new static(sprintf('%s() expects paramter %d to be a pair (array with two elements)', $callee, $position));
        }
    }

    /**
     * @throws static
     */
    private static function assertCollectionAlike(mixed $collection, string $className, string $callee, int $parameterPosition): void
    {
        if (!is_array($collection) && !$collection instanceof $className) {
            throw new static(sprintf('%s() expects parameter %d to be array or instance of %s, %s given', $callee, $parameterPosition, $className, self::getType($collection)),);
        }
    }

    private static function getType(mixed $value): string
    {
        return is_object($value) ? $value::class : gettype($value);
    }
}
