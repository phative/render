<?php

declare(strict_types=1);

namespace Phative\Render\Widget\Factory;

use Phative\Render\Style\StyleParser;
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

    public function build(Container $container, StyleParser $parser, array $options = []): Frame
    {
        $styleOptions = $parser->parse($this->style);

        return new Frame($container, array_merge($styleOptions, $options));
    }
}
