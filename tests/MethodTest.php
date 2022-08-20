<?php

declare(strict_types=1);

namespace Bvsk\Contracts\Http\Request\Tests;

use PHPUnit\Framework\TestCase;
use Bvsk\Contracts\Http\Request\Method;
use ValueError;

/**
 * @covers Method
 */
class MethodTest extends TestCase
{
    /**
     * @dataProvider defaultCasesDataProvider
     */
    public function testCanonicalNameCapitalization(Method $case): void
    {
        $name = $case->name;

        $this->assertThat(
            $name,
            $this->identicalTo(
                strtoupper($name)
            )
        );
    }

    /**
     * @dataProvider defaultCasesDataProvider
     */
    public function testFromNamesUppercase(Method $case): void
    {
        $this->assertThat(
            Method::fromName(name: strtoupper($case->name)),
            $this->identicalTo($case)
        );
    }

    /**
     * @dataProvider defaultCasesDataProvider
     */
    public function testFromNamesLowercase(Method $case): void
    {
        $this->assertThat(
            Method::fromName(name: strtolower($case->name)),
            $this->identicalTo($case)
        );
    }

    /**
     * @dataProvider defaultCasesDataProvider
     */
    public function testFromNamesTitlecase(Method $case): void
    {
        $this->assertThat(
            Method::fromName(name: ucfirst(strtolower($case->name))),
            $this->identicalTo($case)
        );
    }

    /**
     * @dataProvider defaultCasesDataProvider
     */
    public function testFromNamesInvertedTitlecase(Method $case): void
    {
        $this->assertThat(
            Method::fromName(name: lcfirst(strtoupper($case->name))),
            $this->identicalTo($case)
        );
    }

    /**
     * @dataProvider defaultInvalidDataProvider
     */
    public function testInvalidFromName(string $case): void
    {
        $this->expectException(ValueError::class);

        $this->assertThat(
            Method::fromName(name: $case),
            $this->isEmpty()
        );
    }

    public function defaultCasesDataProvider(): iterable
    {
        foreach (Method::cases() as $case) {
            yield [$case];
        }
    }

    public function defaultInvalidDataProvider(): iterable
    {
        yield 'empty' => [''];
        yield 'invalid' => ['FOOBAR'];
    }
}
