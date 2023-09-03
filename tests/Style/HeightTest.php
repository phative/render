<?php

declare(strict_types=1);

namespace Phative\Render\Test\Style;

use Phative\Render\Style\Strategy\Height;
use Phative\Render\Style\StyleType;

class HeightTest extends StyleParserTest
{
    public static function stylesDataProvider(): array
    {
        return [
            ['h-1', StyleType::WIDGET, ['height' => 0.25]],
            ['h-4', StyleType::WIDGET, ['height' => 1]],
            ['h-96', StyleType::WIDGET, ['height' => 24]],
        ];
    }

    protected function strategies(): array
    {
        return [
            new Height(),
        ];
    }
}
