<?php

namespace Tests\Modules\Homeowner\Unit\Traits;

use App\Modules\Homeowner\Traits\ParsesHomeownerNamesTrait;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ParsesHomeownerNamesTraitTest extends TestCase
{
    use ParsesHomeownerNamesTrait;

    #[Test]
    public function it_parses_single_person_with_full_name()
    {
        $names = Collection::make(['Mr John Smith']);
        $results = $this->parseNames($names);

        $this->assertCount(1, $results);
        $homeowner = $results->first();
        $this->assertEquals('Mr', $homeowner->title);
        $this->assertEquals('John', $homeowner->firstName);
        $this->assertNull($homeowner->initial);
        $this->assertEquals('Smith', $homeowner->lastName);
    }

    #[Test]
    public function it_parses_single_person_with_initial()
    {
        $names = Collection::make(['Mr J Smith']);
        $results = $this->parseNames($names);

        $this->assertCount(1, $results);
        $homeowner = $results->first();
        $this->assertEquals('Mr', $homeowner->title);
        $this->assertNull($homeowner->firstName);
        $this->assertEquals('J', $homeowner->initial);
        $this->assertEquals('Smith', $homeowner->lastName);
    }

    #[Test]
    public function it_parses_multiple_people_with_and_connector()
    {
        $names = Collection::make(['Mr and Mrs Smith']);
        $results = $this->parseNames($names);

        $this->assertCount(2, $results);

        $firstHomeowner = $results->first();
        $this->assertEquals('Mr', $firstHomeowner->title);
        $this->assertNull($firstHomeowner->firstName);
        $this->assertNull($firstHomeowner->initial);
        $this->assertEquals('Smith', $firstHomeowner->lastName);

        $secondHomeowner = $results->last();
        $this->assertEquals('Mrs', $secondHomeowner->title);
        $this->assertNull($secondHomeowner->firstName);
        $this->assertNull($secondHomeowner->initial);
        $this->assertEquals('Smith', $secondHomeowner->lastName);
    }

    #[Test]
    public function it_parses_multiple_people_with_mixed_formats()
    {
        $names = Collection::make(['Mr Tom Staff and Mr John Doe']);
        $results = $this->parseNames($names);

        $this->assertCount(2, $results);

        $firstHomeowner = $results->first();
        $this->assertEquals('Mr', $firstHomeowner->title);
        $this->assertEquals('Tom', $firstHomeowner->firstName);
        $this->assertNull($firstHomeowner->initial);
        $this->assertEquals('Staff', $firstHomeowner->lastName);

        $secondHomeowner = $results->last();
        $this->assertEquals('Mr', $secondHomeowner->title);
        $this->assertEquals('John', $secondHomeowner->firstName);
        $this->assertNull($secondHomeowner->initial);
        $this->assertEquals('Doe', $secondHomeowner->lastName);
    }

    #[Test]
    public function it_handles_multiple_collections()
    {
        $names = Collection::make([
            'Mr John Smith',
            'Dr J Doe',
            'Mr and Mrs Charles'
        ]);

        $results = $this->parseNames($names);

        $this->assertCount(4, $results);
    }
}
