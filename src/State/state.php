<?php

declare(strict_types=1);

namespace Phative\Render\State;

function value(mixed $initial): Value
{
    return new Value($initial);
}
