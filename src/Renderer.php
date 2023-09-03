<?php

declare(strict_types=1);

namespace Phative\Render;

use Phative\Render\Style\Strategy\Height;
use Phative\Render\Style\Strategy\Justify;
use Phative\Render\Style\Strategy\Padding;
use Phative\Render\Style\Strategy\Side;
use Phative\Render\Style\Strategy\Width;
use Phative\Render\Style\StyleParser;
use Phative\Render\Style\StyleType;
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
            new Side(),
            new Height(),
            new Width(),
            new Justify(),
        );
    }

    public function render(Container $container, FrameWidgetFactory $frameFactory): array
    {
        $currentFrame = $frameFactory->build($container, $this->styleParser);
        $this->widgets[$currentFrame->path()] = $currentFrame;

        foreach ($frameFactory->widgetFactories as $widgetFactory) {
            $this->build($currentFrame, $widgetFactory);
        }

        return [ $this->widgets, $this->styleParser->parse($frameFactory->style, StyleType::PACK) ];
    }

    private function build(Frame $currentFrame, WidgetFactory $widgetFactory): void
    {
        switch ($widgetFactory::class) {
            case FrameWidgetFactory::class:
                [$widgets, $packStyles] = $this->render($currentFrame, $widgetFactory);
                $currentFrame->pack($widgets, $packStyles);
                break;
            case EntryWidgetFactory::class:
            case ButtonFactory::class:
                $widget = $widgetFactory->build($currentFrame, $this->styleParser);
                $packStyles = $this->styleParser->parse($widgetFactory->style, StyleType::PACK);
                $currentFrame->pack($widget, $packStyles);
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
