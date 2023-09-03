<?php

declare(strict_types=1);

namespace Phative\Render\Style\Strategy;

use Phative\Render\Style\Strategy;
use Phative\Render\Style\StyleType;

class Justify implements Strategy
{
    private const JUSTIFY = ['text-right', 'text-left', 'text-center'];

    public function supports(string $cls): bool
    {
        return in_array($cls, self::JUSTIFY);
    }

    public function parse(string $cls): array
    {
        return [
            'justify' => str_replace('text-', '', $cls),
        ];
    }

    public function styleType(): StyleType
    {
        return StyleType::WIDGET;
    }
}
