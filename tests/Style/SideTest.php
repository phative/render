<?php

declare(strict_types=1);

namespace Phative\Render\Test\Style;

use Phative\Render\Style\Strategy\Side;
use Phative\Render\Style\StyleType;

class SideTest extends StyleParserTest
{
    public static function stylesDataProvider(): array
    {
        return [
            ['left', StyleType::PACK, ['side' => 'left']],
            ['right', StyleType::PACK, ['side' => 'right']],
            ['top', StyleType::PACK, ['side' => 'top']],
            ['bottom', StyleType::PACK, ['side' => 'bottom']],
        ];
    }

    protected function strategies(): array
    {
        return [
            new Side(),
        ];
    }
}
