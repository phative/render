<?php

declare(strict_types=1);

namespace Phative\Render\Style\Strategy;

use Phative\Render\Style\Strategy;

class Side implements Strategy
{
    private const SIDES = ['left', 'right', 'top', 'bottom'];

    public function supports(string $cls): bool
    {
        return in_array($cls, self::SIDES);
    }

    public function parse(string $cls): array
    {
        if (!$this->supports($cls)) {
            return [];
        }

        return [
            'side' => $cls,
        ];
    }
}
