<?php

declare(strict_types=1);

namespace Phative\Render\Style\Strategy;

use Phative\Render\Style\SizeUnit;
use Phative\Render\Style\Strategy;
use Phative\Render\Style\StyleType;

class Height implements Strategy
{
    public function supports(string $cls): bool
    {
        return str_starts_with($cls, 'h-');
    }

    public function styleType(): StyleType
    {
        return StyleType::WIDGET;
    }

    public function parse(string $cls): array
    {
        if (!$this->supports($cls)) {
            return [];
        }

        $clsParts = explode('-', $cls);

        if (count($clsParts) < 2) {
            throw new \Exception('Height class is not valid');
        }

        [, $size] = $clsParts;

        if (!is_numeric($size)) {
            throw new \Exception('Height class size is not numeric');
        }

        if (!in_array($size, SizeUnit::AVAILABLE_SIZE_LIST)) {
            throw new \Exception('Height class size is not available');
        }

        $realSize = $size * SizeUnit::ONE;

        return [
            'height' => $realSize,
        ];
    }
}
