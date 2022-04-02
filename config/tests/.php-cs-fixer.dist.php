<?php

declare(strict_types=1);

$currentDirectory = __DIR__;
$rootDirectory = dirname($currentDirectory, 2);

$finder = (new PhpCsFixer\Finder())
    ->name('*.php')
    ->notName('*Spec.php')
    ->in([
        "$rootDirectory/src",
        "$rootDirectory/tests"
    ])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'final_class' => true,
        'declare_strict_types' => true,
        'void_return' => true,
        'phpdoc_align' => false,
        'use_arrow_functions' => true,
        'is_null' => true,
    ])
    ->setCacheFile("$rootDirectory/var/.php-cs-fixer.cache")
    ->setFinder($finder)
    ->setRiskyAllowed(true)
;
