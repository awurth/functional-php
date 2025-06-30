<?php

/**
 * @package   Functional-php
 * @author    Lars Strojny <lstrojny@php.net>
 * @copyright 2011-2021 Lars Strojny
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://github.com/lstrojny/functional-php
 */

namespace Functional\Tests;

use Functional\Functional;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

use function array_map;
use function get_defined_functions;
use function preg_grep;
use function str_replace;

class FunctionalTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testAllDefinedConstantsAreValidCallables(): void
    {
        $functionalClass = new ReflectionClass(Functional::class);
        $functions = $functionalClass->getConstants();

        foreach ($functions as $function) {
            if ('\\Functional\\match' === $function) {
                continue;
            }

            self::assertIsCallable($function);
        }
    }

    public function testShouldHaveDefinedConstantsForAllFunctions(): void
    {
        $functions = get_defined_functions(true);
        $functionalFunctions = preg_grep('/functional\\\(?!tests)/', $functions['user']);
        $expectedFunctions = array_map(
            static function ($function) {
                return str_replace('functional\\', '\\Functional\\', $function);
            },
            $functionalFunctions,
        );

        $functionalClass = new ReflectionClass(Functional::class);
        $constants = $functionalClass->getConstants();

        foreach ($expectedFunctions as $function) {
            self::assertContains($function, $constants);
        }
    }
}
