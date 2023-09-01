<?php

declare(strict_types=1);

namespace Phative\Render;

use Phative\Render\Style\Strategy\Padding;
use Phative\Render\Style\StyleParser;
use Phative\Render\Widget\Factory\ButtonFactory;
use Phative\Render\Widget\Factory\EntryWidgetFactory;
use Phative\Render\Widget\Factory\FrameWidgetFactory;
use Phative\Render\Widget\Factory\WidgetFactory;
use Tkui\Widgets\Container;
use Tkui\Widgets\Frame;

class Renderer
{
    private array $widgets = [];
    private StyleParser $styleParser;

    public function __construct() {
        $this->styleParser = new StyleParser(
            new Padding(),
        );
    }

    public function render(Container $container, FrameWidgetFactory $frameFactory): array
    {
        $currentFrame = $frameFactory->build($container, $this->styleParser);
        $this->widgets[$currentFrame->path()] = $currentFrame;

        foreach ($frameFactory->widgetFactories as $widgetFactory) {
            $this->build($currentFrame, $widgetFactory);
        }

        return $this->widgets;
    }

    private function build(Frame $currentFrame, WidgetFactory $widgetFactory): void
    {
        switch ($widgetFactory::class) {
            case FrameWidgetFactory::class:
                $currentFrame->pack($this->render($currentFrame, $widgetFactory));
                break;
            case EntryWidgetFactory::class:
            case ButtonFactory::class:
                $widget = $widgetFactory->build($currentFrame, $this->styleParser);
                $this->widgets[$widget->path()] = $widget;
                break;
        }
    }

    public function __destruct()
    {
        foreach ($this->widgets as $widget) {
            unset($widget);
        }
    }
}
