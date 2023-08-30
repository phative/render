<?php

declare(strict_types=1);

namespace Phative\Render\Widget\Factory;

use Closure;
use Tkui\Widgets\Buttons\Button;
use Tkui\Widgets\Container;

readonly class ButtonFactory implements WidgetFactory
{
    public function __construct(
        public string $style,
        public string $title,
        public ?Closure $onClick = null,
    ) {}

    public function build(Container $container, array $options = []): Button
    {
        if (null !== $this->onClick) {
            $options['onClick'] = $this->onClick;
        }

        return new Button(
            $container,
            $this->title,
            $options,
        );
    }
}
