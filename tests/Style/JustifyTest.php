<?php

declare(strict_types=1);

namespace Phative\Render\Test\Style;

use Phative\Render\Style\Strategy\Justify;
use Phative\Render\Style\StyleType;

class JustifyTest extends StyleParserTest
{
    public static function stylesDataProvider(): array
    {
        return [
            ['text-left', StyleType::WIDGET, ['justify' => 'left']],
            ['text-center', StyleType::WIDGET, ['justify' => 'center']],
            ['text-right', StyleType::WIDGET, ['justify' => 'right']],
        ];
    }

    protected function strategies(): array
    {
        return [
            new Justify(),
        ];
    }
}
