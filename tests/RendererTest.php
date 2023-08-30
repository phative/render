<?php

declare(strict_types=1);

namespace Phative\Render\Test;

use Phative\Render\Renderer;
use Phative\Render\State\Value;
use PHPUnit\Framework\TestCase;
use Tkui\DotEnv;
use Tkui\TclTk\TkAppFactory;
use Tkui\Windows\MainWindow;
use function Phative\Render\Widget\entry;
use function Phative\Render\Widget\frame;

class RendererTest extends TestCase
{
    private Renderer $renderer;

    public function setUp(): void
    {
        $this->renderer = new Renderer();
    }

    public function testIfFrameIsBuiltCorrectly(): void
    {
        $factory = new TkAppFactory('');
        $app = $factory->createFromEnvironment(DotEnv::create(dirname(__DIR__)));
        $window = new MainWindow($app, '');

        $value = new Value();

        $layout = frame('',
            entry(style: '', value: $value),
            frame('',
                entry(style: '', value: $value),
            ),
            entry(style: '', value: $value),
        );

        $rendered = $this->renderer->render($window, $layout);

        self::assertSame([
            '.fr1',
            '.fr1.e1',
            '.fr1.fr2',
            '.fr1.fr2.e2',
            '.fr1.e3',
        ], array_keys($rendered));
    }
}
