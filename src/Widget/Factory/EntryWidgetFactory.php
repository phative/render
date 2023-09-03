<?php

declare(strict_types=1);

namespace Phative\Render\Widget\Factory;

use Closure;
use Phative\Render\State\Value;
use Phative\Render\Style\StyleParser;
use Phative\Render\Style\StyleType;
use Tkui\Widgets\Container;
use Tkui\Widgets\Entry;

readonly class EntryWidgetFactory implements WidgetFactory
{
    public function __construct(
        public string $style,
        public Value $value,
        public ?Closure $onSubmit = null,
    ) {}

    public function build(Container $container, StyleParser $parser, array $options = []): Entry
    {
        $styleOptions = $parser->parse($this->style, StyleType::WIDGET);

        $entry = new Entry(
            $container,
            (string)$this->value,
            array_merge($styleOptions, $options),
        );

        $this->value->attach($entry);

        if (null !== $this->onSubmit) {
            $entry->onSubmit($this->onSubmit);
        }

        return $entry;
    }
}
