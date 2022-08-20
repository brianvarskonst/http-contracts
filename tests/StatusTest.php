<?php

declare(strict_types=1);

namespace Bvsk\Contracts\Http\Request\Tests;

use PHPUnit\Framework\TestCase;
use Bvsk\Contracts\Http\Request\Status;
use ValueError;

/**
 * @covers Status
 */
class StatusTest extends TestCase
{
    /**
     * @dataProvider defaultMessagesDataProvider
     */
    public function testFromNames(string $case, string $message): void
    {
        $this->assertThat(
            Status::fromMessage($message),
            $this->identicalTo(
                Status::fromPhrase($case)
            )
        );
    }

    /**
     * @dataProvider defaultCodesDataProvider
     */
    public function testFromCode(string $case, int $code): void
    {
        $this->assertThat(
            Status::fromCode(code: $code),
            $this->identicalTo(Status::fromPhrase($case))
        );
    }

    /**
     * @dataProvider defaultCodesDataProvider
     */
    public function testStatusCodeConversion(string $case, int $code): void
    {
        $statusCode = Status::fromPhrase(phrase: $case);
        $reasonPhrase = Status::fromCode(code: $code);

        $this->assertThat(
            $reasonPhrase,
            $this->identicalTo($statusCode)
        );
    }

    /**
     * @dataProvider defaultInvalidPhraseDataProvider
     */
    public function testInvalidPhrases(mixed $phrase): void
    {
        $this->expectException(ValueError::class);

        Status::fromPhrase(phrase: $phrase);
    }

    /**
     * @dataProvider defaultInvalidCodesDataProvider
     */
    public function testInvalidCodes(mixed $code): void
    {
        $this->expectException(ValueError::class);

        Status::fromCode(code: $code);
    }

    public function defaultMessagesDataProvider(): iterable
    {
        foreach (Status::messages() as $case => $message) {
            yield [$case, $message];
        }
    }

    public function defaultCodesDataProvider(): iterable
    {
        foreach (Status::codesWithContext() as $case => $code) {
            yield [$case, $code];
        }
    }

    public function defaultInvalidPhraseDataProvider(): iterable
    {
        yield 'empty' => [''];
        yield 'invalid' => ['INVALID'];
        yield 'unused' => ['UNUSED'];
    }

    public function defaultInvalidCodesDataProvider(): iterable
    {
        yield 'zero' => [0];
        yield 'minus' => [-1];
        yield '306' => [306];
    }
}
