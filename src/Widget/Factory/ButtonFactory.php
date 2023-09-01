<?php

declare(strict_types=1);

namespace Phative\Render\Widget\Factory;

use Closure;
use Phative\Render\Style\StyleParser;
use Tkui\Widgets\Buttons\Button;
use Tkui\Widgets\Container;

readonly class ButtonFactory implements WidgetFactory
{
    public function __construct(
        public string $style,
        public string $title,
        public ?Closure $onClick = null,
    ) {}

    public function build(Container $container, StyleParser $parser, array $options = []): Button
    {
        $styleOptions = $parser->parse($this->style);

        $button = new Button(
            $container,
            $this->title,
            array_merge($styleOptions, $options),
        );

        if (null !== $this->onClick) {
            $button->onClick($this->onClick);
        }

        return $button;
    }
}
