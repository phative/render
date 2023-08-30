<?php

declare(strict_types=1);

namespace Phative\Render\Style;

interface Strategy
{
    public function supports(string $cls): bool;

    /**
     * @return array<string, mixed>
     */
    public function parse(string $cls): array;
}
