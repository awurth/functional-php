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
use DomainException;
use Functional\Exceptions\InvalidArgumentException;
use Iterator;
use PHPUnit\Framework\TestCase;
use TypeError;

use function count;
use function func_get_args;
use function func_num_args;
use function preg_quote;
use function sprintf;

abstract class AbstractTestCase extends TestCase
{
    protected array $list;

    protected ArrayIterator $listIterator;

    protected array $hash;

    protected ArrayIterator $hashIterator;

    protected function expectArgumentError(string $message): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);
    }

    protected function expectCallableArgumentError(string $fn, int $position, string $actualType = 'string'): void
    {
        $this->expectException(TypeError::class);

        $this->expectExceptionMessageMatches(
            sprintf(
                '/^%s\(\): Argument \#%d( \(\$callback\))? must be of type \??callable, %s given.*/',
                preg_quote($fn, '/'),
                $position,
                $actualType,
            ),
        );
    }

    public function exception(): void
    {
        if (func_num_args() < 3) {
            throw new DomainException('Callback exception');
        }

        $args = func_get_args();
        self::assertGreaterThanOrEqual(3, count($args));
        throw new DomainException(sprintf('Callback exception: %s', $args[1]));
    }

    protected function sequenceToArray(Iterator $sequence, int $limit): array
    {
        $values = [];
        $sequence->rewind();
        for ($a = 0; $a < $limit; ++$a) {
            $values[] = $sequence->current();
            $sequence->next();
        }

        return $values;
    }
}
