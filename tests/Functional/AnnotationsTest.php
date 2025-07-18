<?php

/**
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 *
 * @see      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use ReflectionFunction;

use function array_filter;
use function array_values;
use function Functional\group;
use function get_defined_functions;
use function sprintf;
use function stripos;

class AnnotationsTest extends AbstractTestCase
{
    public static function getFunctions(): array
    {
        return group(
            array_values(
                array_filter(
                    get_defined_functions()['user'],
                    static fn (string $function): bool => stripos($function, 'Functional\\') === 0,
                ),
            ),
            'Functional\id',
        );
    }

    #[DataProvider('getFunctions')]
    public function testNamedArgumentsNotSupportedInFunctions(string $function): void
    {
        $refl = new ReflectionFunction($function);
        self::assertStringContainsString(
            '@no-named-arguments',
            $refl->getDocComment(),
            sprintf(
                'Expected function "%s()" to have annotation @no-named-arguments',
                $function,
            ),
        );
    }
}
