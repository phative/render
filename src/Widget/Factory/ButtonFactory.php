<?php

declare(strict_types=1);

namespace Phative\Render\Widget\Factory;

use Closure;
use Phative\Render\Style\StyleParser;
use Phative\Render\Style\StyleType;
use Tkui\Widgets\Buttons\Button;
use Tkui\Widgets\Container;
use Tkui\Widgets\Frame;
use Tkui\Widgets\Widget;

readonly class ButtonFactory implements WidgetFactory
{
    public function __construct(
        public string $style,
        public string $title,
        public ?Closure $onClick = null,
    ) {}

    public function build(Container $container, StyleParser $parser, array $options = []): Widget
    {
        $styleOptions = $parser->parse($this->style, StyleType::WIDGET);

        $frameStyle = [
            'width' => 30,
            'height' => 30,
        ];

        if (isset($styleOptions['width'])) {
            $frameStyle['width'] = (int)$styleOptions['width'];
        }

        if (isset($styleOptions['height'])) {
            $frameStyle['height'] = $styleOptions['height'];
        }

        $buttonFrame = new Frame($container, $frameStyle);

        $button = new Button(
            $buttonFrame,
            $this->title,
            array_merge($styleOptions, $options),
        );

        $buttonFrame->pack($button, [
            'fill' => 'both',
        ]);

        $buttonFrame->getEval()->tclEval('pack', 'propagate', $buttonFrame->path(), 0);

        if (null !== $this->onClick) {
            $button->onClick($this->onClick);
        }

        return $buttonFrame;
    }
}
