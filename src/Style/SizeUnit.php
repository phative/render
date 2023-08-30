<?php

declare(strict_types=1);

namespace Phative\Render\Style;

class SizeUnit
{
    // 1 = 4px
    public const ONE = 4;

    public const AVAILABLE_SIZE_LIST = [
        '0', '0.5', '1', '1.5', '2', '2.5', '3', '3.5', '4', '5', '6', '7', '8', '9', '10',
        '11', '12', '14', '16', '20', '24', '28', '32', '36', '44', '52', '56', '60',
        '64', '72', '80', '96',
    ];
}
