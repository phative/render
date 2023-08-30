<?php

declare(strict_types=1);

namespace Phative\Render\Widget;

use Closure;
use Phative\Render\State\Value;
use Phative\Render\Widget\Factory\ButtonFactory;
use Phative\Render\Widget\Factory\EntryWidgetFactory;
use Phative\Render\Widget\Factory\FrameWidgetFactory;
use Phative\Render\Widget\Factory\WidgetFactory;

function frame(string $style, WidgetFactory ...$widgetFactories): FrameWidgetFactory
{
    return new FrameWidgetFactory($style, $widgetFactories);
}

function entry(string $style, Value $value, ?Closure $onSubmit = null): EntryWidgetFactory
{
    return new EntryWidgetFactory($style, $value, $onSubmit);
}

function button(string $style, string $title, ?Closure $onClick = null): ButtonFactory
{
    return new ButtonFactory($style, $title, $onClick);
}
