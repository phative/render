<?php

declare(strict_types=1);

namespace Phative\Render\Style;

readonly class StyleParser
{
    /** @var Strategy[] */
    private array $strategies;

    public function __construct(Strategy ...$strategies)
    {
        $this->strategies = $strategies;
    }

    /**
     * @return array<string, string>[]
     */
    public function parse(string $style, StyleType $styleType): array
    {
        $clss = explode(' ', $style);

        $parsedStyles = [];

        foreach ($clss as $cls) {
            foreach ($this->strategies as $strategy) {
                if (!$strategy->supports($cls)) {
                    continue;
                }

                if ($strategy->styleType() !== $styleType) {
                    continue;
                }

                $parsedStyles = array_merge($parsedStyles, $strategy->parse($cls));
                break;
            }
        }

        return $parsedStyles;
    }
}
