<?php

declare(strict_types=1);

namespace Phative\Render\Style\Strategy;

use Phative\Render\Style\SizeUnit;
use Phative\Render\Style\Strategy;

class Padding implements Strategy
{
    public function supports(string $cls): bool
    {
        return str_starts_with($cls, 'p-');
    }

    public function parse(string $cls): array
    {
        $clsParts = explode('-', $cls);

        if (!$this->supports($cls)) {
            throw new \Exception('Class not supported by padding');
        }

        if (count($clsParts) < 2) {
            throw new \Exception('Padding class is not valid');
        }

        [, $size] = $clsParts;

        if (!is_numeric($size)) {
            throw new \Exception('Padding class size is not numeric');
        }

        if (!in_array($size, SizeUnit::AVAILABLE_SIZE_LIST)) {
            throw new \Exception('Padding class size is not available');
        }

        $realSize = $size * SizeUnit::ONE;

        return [
            'padding' => $realSize,
        ];
    }
}
