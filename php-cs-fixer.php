<?php

declare(strict_types=1);
// phpcs:ignoreFile

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = (new Finder())
    ->in(__DIR__);

return (new Config())
    ->setRules(
        [
            '@PSR12' => true,
            '@PhpCsFixer' => true,
            '@PHP83Migration' => true,
            'yoda_style' => true,
            'modernize_strpos' => true,
            'no_useless_concat_operator' => true,
            'numeric_literal_seperator' => true,
            'header_comment' => [
                'header' => '',
            ],
            'no_superfluous_phpdoc_tags' => false,
            'phpdoc_to_comment' => false,
            'trailing_comma_in_multiline' => false,
            'no_useless_else' => true,
            'no_useless_return' => true,
            'ordered_imports' => true,
            'phpdoc_no_package' => false,
            'phpdoc_order' => true,
            'phpdoc_summary' => false
        ]
    )
    ->setFinder($finder);
