<?php

declare(strict_types=1);

namespace Phative\Render\Test\Style;

use Phative\Render\Style\Strategy\Padding;
use Phative\Render\Style\StyleType;

class PaddingTest extends StyleParserTest
{
    public static function stylesDataProvider(): array
    {
        return [
            ['p-1', StyleType::PACK, ['padx' => 0.25, 'pady' => 0.25, 'ipadx' => 0.25, 'ipady' => 0.25]],
            ['p-0.5', StyleType::PACK, ['padx' => 0.125, 'pady' => 0.125, 'ipadx' => 0.125, 'ipady' => 0.125]],
            ['p-96', StyleType::PACK, ['padx' => 24, 'pady' => 24, 'ipadx' => 24, 'ipady' => 24]],
        ];
    }

    protected function strategies(): array
    {
        return [
            new Padding(),
        ];
    }
}
