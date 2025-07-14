<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use DateTime;
use DateTimeInterface;
use PHPUnit\Framework\Attributes\DataProvider;

use function array_shift;
use function call_user_func_array;
use function count;
use function Functional\curry_n;
use function Functional\id;
use function Functional\invoker;

function add($a, $b, $c, $d)
{
    return $a + $b + $c + $d;
}

class Adder
{
    public static function staticAdd($a, $b, $c, $d)
    {
        return add($a, $b, $c, $d);
    }

    public function add($a, $b, $c, $d)
    {
        return static::staticAdd($a, $b, $c, $d);
    }

    public function __invoke($a, $b, $c, $d)
    {
        return static::staticAdd($a, $b, $c, $d);
    }
}

class CurryNTest extends AbstractPartialTestCase
{
    protected function getCurryiedCallable(callable $callback, array $params, bool $required): callable
    {
        return curry_n(count($params), $callback);
    }

    #[DataProvider('callbacks')]
    public function testCallbackTypes($callback, $params, $expected, $required, $transformer = null): void
    {
        if (null === $transformer) {
            $transformer = id(...);
        }

        $curryied = $this->getCurryiedCallable($callback, $params, $required);

        self::assertEquals($transformer($expected), $transformer(call_user_func_array($curryied, $params)));

        $length = count($params);
        for ($i = 0; $i < $length; ++$i) {
            $p = array_shift($params);

            $curryied = $curryied($p);

            if (count($params) > 0) {
                self::assertIsCallable($curryied);
                self::assertEquals($transformer($expected), $transformer(call_user_func_array($curryied, $params)));
            } else {
                self::assertEquals($transformer($expected), $transformer($curryied));
            }
        }
    }

    public static function callbacks(): array
    {
        $dt = new DateTime();
        $dt2 = clone $dt;

        $dateFormat = invoker('format', [DateTimeInterface::ATOM]);

        return [
            ['Functional\Tests\add', [2, 4, 6, 8], 20, true],
            [Adder::staticAdd(...), [2, 4, 6, 8], 20, true],
            ['Functional\Tests\Adder::staticAdd', [2, 4, 6, 8], 20, true],
            [new Adder(), [2, 4, 6, 8], 20, true],
            [[new Adder(), 'add'], [2, 4, 6, 8], 20, true],
            [[new Adder(), 'staticAdd'], [2, 4, 6, 8], 20, true],

            ['number_format', [1.234, 2, ',', '\''], '1,23', false],
            [['DateTime', 'createFromFormat'], [DateTimeInterface::ATOM, $dt->format(DateTimeInterface::ATOM)], $dt, true, $dateFormat],
            ['DateTime::createFromFormat', [DateTimeInterface::ATOM, $dt->format(DateTimeInterface::ATOM)], $dt, true, $dateFormat],
            [[new DateTime(), 'createFromFormat'], [DateTimeInterface::ATOM, $dt->format(DateTimeInterface::ATOM)], $dt, true, $dateFormat],
            [[new DateTime(), 'setTime'], [10, 10], $dt2->setTime(10, 10), true, $dateFormat],
        ];
    }
}
