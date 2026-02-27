<?php

declare(strict_types=1);

namespace App\Tests\SongManagement\Domain\Model\Song;

use App\SongManagement\Domain\Model\Song\Title;
use PHPUnit\Framework\TestCase;

final class TitleTest extends TestCase
{
    public function testCreatesFromValidString(): void
    {
        $title = new Title('My Song Title');

        self::assertInstanceOf(Title::class, $title);
    }

    public function testReturnsTheTitleValue(): void
    {
        $titleValue = 'Beautiful Day';
        $title = new Title($titleValue);

        self::assertSame($titleValue, $title->value());
    }

    public function testConvertsToStringWithMagicMethod(): void
    {
        $titleValue = 'Bohemian Rhapsody';
        $title = new Title($titleValue);

        self::assertSame($titleValue, (string) $title);
    }

    public function testAcceptsEmptyString(): void
    {
        $title = new Title('');

        self::assertSame('', $title->value());
    }

    public function testAcceptsSingleCharacter(): void
    {
        $title = new Title('A');

        self::assertSame('A', $title->value());
    }

    public function testAcceptsVeryLongString(): void
    {
        $longTitle = str_repeat('a', 1000);
        $title = new Title($longTitle);

        self::assertSame($longTitle, $title->value());
    }

    public function testAcceptsStringWithSpecialCharacters(): void
    {
        $titleWithSpecial = "Song's \"Title\" & More! (Remix) [2024]";
        $title = new Title($titleWithSpecial);

        self::assertSame($titleWithSpecial, $title->value());
    }

    public function testAcceptsStringWithNumbers(): void
    {
        $titleWithNumbers = 'Song 123 - Part 2';
        $title = new Title($titleWithNumbers);

        self::assertSame($titleWithNumbers, $title->value());
    }

    public function testAcceptsStringWithUnicodeCharacters(): void
    {
        $titleWithUnicode = 'Café ☺️ 日本語';
        $title = new Title($titleWithUnicode);

        self::assertSame($titleWithUnicode, $title->value());
    }

    public function testAcceptsStringWithMultipleSpaces(): void
    {
        $titleWithSpaces = 'Song    With    Multiple    Spaces';
        $title = new Title($titleWithSpaces);

        self::assertSame($titleWithSpaces, $title->value());
    }

    public function testAcceptsStringWithLeadingAndTrailingSpaces(): void
    {
        $titleWithWhitespace = '  Song Title  ';
        $title = new Title($titleWithWhitespace);

        self::assertSame($titleWithWhitespace, $title->value());
    }

    public function testAcceptsStringWithNewlines(): void
    {
        $titleWithNewlines = "Line 1\nLine 2\nLine 3";
        $title = new Title($titleWithNewlines);

        self::assertSame($titleWithNewlines, $title->value());
    }

    public function testAcceptsStringWithTabs(): void
    {
        $titleWithTabs = "Title\tWith\tTabs";
        $title = new Title($titleWithTabs);

        self::assertSame($titleWithTabs, $title->value());
    }

    public function testImmutableValue(): void
    {
        $title = new Title('Original Title');

        self::assertSame('Original Title', $title->value());
        self::assertTrue((new \ReflectionClass($title))->getProperty('value')->isReadonly());
    }

    public function testTwoInstancesWithSameValueAreNotSameObject(): void
    {
        $title1 = new Title('Same Title');
        $title2 = new Title('Same Title');

        self::assertNotSame($title1, $title2);
    }

    public function testTwoInstancesWithSameValueHaveSameStringRepresentation(): void
    {
        $titleValue = 'Common Title';
        $title1 = new Title($titleValue);
        $title2 = new Title($titleValue);

        self::assertSame((string) $title1, (string) $title2);
    }
}
