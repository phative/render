<?php

declare(strict_types=1);

namespace Phative\Render\Tests\Style;

use Phative\Render\Style\Strategy\Padding;
use Phative\Render\Style\Strategy\Side;
use Phative\Render\Style\StyleParser;
use PHPUnit\Framework\TestCase;

class StyleParserTest extends TestCase
{
    private StyleParser $styleParser;

    public function setUp(): void
    {
        $padding = new Padding();
        $side = new Side();
        $this->styleParser = new StyleParser(
            $padding,
            $side,
        );
    }

    /**
     * @dataProvider stylesDataProvider
     */
    public function testParsingStyles($cls, $style = null): void
    {
        if (null === $style) {
            self::expectException(\Exception::class);
        }

        $parsed = $this->styleParser->parse($cls);

        if (null !== $style) {
            self::assertEquals($style, $parsed);
        }
    }

    public static function stylesDataProvider(): array
    {
        return [
            ['p-1', ['padding' => 4]],
            ['p-0.5', ['padding' => 2]],
            ['p-2', ['padding' => 8]],
            ['p-4', ['padding' => 16]],
            ['p-96', ['padding' => 384]],
            ['p-7.5', null],
            ['p-13', null],
            ['p-90', null],
            ['p-97', null],
            ['p-120', null],
            ['p-abcd', null],
            ['left', ['side' => 'left']],
            ['right', ['side' => 'right']],
            ['top', ['side' => 'top']],
            ['bottom', ['side' => 'bottom']],
            ['width', ]
        ];
    }
}
