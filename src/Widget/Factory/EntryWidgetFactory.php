<?php

declare(strict_types=1);

namespace Phative\Render\Widget\Factory;

use Closure;
use Phative\Render\State\Value;
use Tkui\Widgets\Container;
use Tkui\Widgets\Entry;

readonly class EntryWidgetFactory implements WidgetFactory
{
    public function __construct(
        public string $style,
        public Value $value,
        public ?Closure $onSubmit = null,
    ) {}

    public function build(Container $container, array $options = []): Entry
    {
        if (null !== $this->onSubmit) {
            $options['onSubmit'] = $this->onSubmit;
        }

        return new Entry(
            $container,
            (string)$this->value,
            $options,
        );
    }
}