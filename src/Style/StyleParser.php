<?php

declare(strict_types=1);

namespace Phative\Render\Style;

readonly class StyleParser
{
    /**
     * @param Strategy[] $strategies
     */
    public function __construct(private array $strategies) {}

    /**
     * @return array<string, string>[]
     */
    public function parse(string $style): array
    {
        $clss = explode(' ', $style);

        $parsedStyles = [];

        foreach ($clss as $cls) {
            foreach ($this->strategies as $strategy) {
                if (!$strategy->supports($cls)) {
                    continue;
                }

                $parsedStyles = array_merge($parsedStyles, $strategy->parse($cls));
                break;
            }
        }

        return $parsedStyles;
    }
}
