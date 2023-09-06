<?php

declare(strict_types=1);

namespace Phative\Render\Widget\Factory;

use Closure;
use Phative\Render\State\Value;
use Phative\Render\Style\StyleParser;
use Phative\Render\Style\StyleType;
use Tkui\Widgets\Container;
use Tkui\Widgets\Entry;
use Tkui\Widgets\Frame;
use Tkui\Widgets\Widget;

readonly class EntryWidgetFactory implements WidgetFactory
{
    public function __construct(
        public string $style,
        public Value $value,
        public ?Closure $onSubmit = null,
        public bool $readonly = false,
        public bool $disabled = false,
        public bool $password = false,
    ) {}

    public function build(Container $container, StyleParser $parser, array $options = []): Widget
    {
        $styleOptions = $parser->parse($this->style, StyleType::WIDGET);

        if ($this->readonly) {
            $options['state'] = 'readonly';
        }

        if ($this->disabled) {
            $options['state'] = 'disabled';
        }

        if ($this->password) {
            $options['show'] = '*';
        }

        $frameStyle = [
            'width' => 5,
            'height' => 5,
        ];

        if (isset($styleOptions['width'])) {
            $frameStyle['width'] = $styleOptions['width'];
            unset($styleOptions['width']);
        }

        if (isset($styleOptions['height'])) {
            $frameStyle['height'] = $styleOptions['height'];
            unset($styleOptions['height']);
        }

        $entryFrame = new Frame($container, $frameStyle);

        $entry = new Entry(
            $container,
            (string)$this->value,
            array_merge($styleOptions, $options),
        );

        $entryFrame->getEval()->tclEval('pack', 'propagate', $entryFrame->path(), 0);

        $entryFrame->pack($entry, [
            'fill' => 'both',
        ]);

        $this->value->attach($entry);

        if (null !== $this->onSubmit) {
            $entry->onSubmit($this->onSubmit);
        }

        return $entryFrame;
    }
}
