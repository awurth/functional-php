<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\PHPUnit\Set\PHPUnitSetList;

return RectorConfig::configure()
    ->withParallel()
    ->withPaths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ])
    ->withImportNames()
    ->withAttributesSets()
    ->withPreparedSets(
        // deadCode: true,
        // codeQuality: true,
        // typeDeclarations: true,
        privatization: true,
        instanceOf: true,
        earlyReturn: true,
        strictBooleans: true,
        // rectorPreset: true,
    )
    // ->withComposerBased(phpunit: true)
    // ->withPhpSets()
    ->withSets([
        PHPUnitSetList::PHPUNIT_100,
    ])
;
