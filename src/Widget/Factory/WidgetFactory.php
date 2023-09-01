<?php

declare(strict_types=1);

namespace Phative\Render\Widget\Factory;

use Phative\Render\Style\StyleParser;
use Tkui\Widgets\Container;

interface WidgetFactory
{
    public function build(Container $container, StyleParser $parser, array $options = []): mixed;
}
