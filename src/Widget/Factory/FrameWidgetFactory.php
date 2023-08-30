<?php

declare(strict_types=1);

namespace Phative\Render\Widget\Factory;

use Tkui\Widgets\Container;
use Tkui\Widgets\Frame;

readonly class FrameWidgetFactory implements WidgetFactory
{
    /**
     * @param WidgetFactory[] $widgetFactories
     */
    public function __construct(
        public string $style,
        public array  $widgetFactories,
    ) {}

    public function build(Container $container, array $options = []): Frame
    {
        return new Frame($container, $options);
    }
}
