<?php

declare(strict_types=1);

namespace Phative\Render\Widget\Factory;

use Tkui\Widgets\Container;

interface WidgetFactory
{
    public function build(Container $container, array $options = []): mixed;
}
