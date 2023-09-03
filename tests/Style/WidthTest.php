<?php

declare(strict_types=1);

namespace Phative\Render\Test\Style;

use Phative\Render\Style\Strategy\Width;
use Phative\Render\Style\StyleType;

class WidthTest extends StyleParserTest
{
    public static function stylesDataProvider(): array
    {
        return [
            ['w-1', StyleType::WIDGET, ['width' => 0.25]],
            ['w-4', StyleType::WIDGET, ['width' => 1]],
            ['w-96', StyleType::WIDGET, ['width' => 24]],
        ];
    }

    protected function strategies(): array
    {
        return [
            new Width(),
        ];
    }
}
