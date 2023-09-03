<?php

declare(strict_types=1);

namespace Phative\Render\Test\Style;

use Phative\Render\Style\Strategy;
use Phative\Render\Style\StyleParser;
use Phative\Render\Style\StyleType;
use PHPUnit\Framework\TestCase;

abstract class StyleParserTest extends TestCase
{
    private StyleParser $styleParser;

    public function setUp(): void
    {
        $this->styleParser = new StyleParser(...$this->strategies());
    }

    /**
     * @return Strategy[]
     */
    abstract protected function strategies(): array;

    /**
     * @dataProvider stylesDataProvider
     */
    public function testParsingStyle($cls, StyleType $styleType, $style = null): void
    {
        if (null === $style) {
            self::expectException(\Exception::class);
        }

        $parsed = $this->styleParser->parse($cls, $styleType);

        if (null !== $style) {
            self::assertEquals($style, $parsed);
        }
    }

    abstract public static function stylesDataProvider(): array;
}
