<?php

/**
 * @author    Hugo Sales <hugo@fc.up.pt>
 * @copyright 2020 Hugo Sales
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional;

use Functional\Exceptions\InvalidArgumentException;

/**
 * Call $func with only abs($count) arguments, taken either from the
 * left or right depending on the sign.
 *
 * @no-named-arguments
 */
function ary(callable $func, int $count): callable
{
    InvalidArgumentException::assertNonZeroInteger($count, __FUNCTION__);

    return static function (...$args) use ($func, $count) {
        if ($count > 0) {
            return $func(...take_left($args, $count));
        }
        if ($count < 0) {
            return $func(...take_right($args, -$count));
        }
    };
}
