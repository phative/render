<?php

declare(strict_types=1);

namespace Phative\Render\Style;

use Exception;

class FrameStyleTranslator
{
    private const SUPPORTED_STYLES = [
        'padding',
        'borderWidth',
        'relief',
        'width',
        'height',
    ];

    public function __construct(
        private readonly StyleParser $parser,
    ) {
    }

    public function parse(string $style): array
    {
        $parsedStyles = $this->parser->parse($style);
        $unsupportedStyles = array_filter(
            $parsedStyles,
            fn ($name) => !in_array($name, self::SUPPORTED_STYLES),
            ARRAY_FILTER_USE_KEY
        );

        if (count($unsupportedStyles) > 0) {
            throw new Exception();
        }

        return $parsedStyles;
    }
}
