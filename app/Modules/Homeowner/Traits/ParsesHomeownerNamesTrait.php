<?php

namespace App\Modules\Homeowner\Traits;

use App\Modules\Homeowner\DataTransferObjects\HomeownerData;
use App\Modules\Homeowner\Enums\NameConnector;
use App\Modules\Homeowner\Enums\NamePattern;
use App\Modules\Homeowner\Enums\Title;
use Illuminate\Support\Collection;

trait ParsesHomeownerNamesTrait
{
    public function parseNames(Collection $homeowners): Collection
    {
        return $homeowners->flatMap(function ($name) {
            if (NameConnector::hasConnector($name)) {
                return $this->parseMultiplePeople($name);
            }

            return collect([$this->parseSinglePerson($name)]);
        });
    }

    private function parseMultiplePeople(string $fullName): Collection
    {
        $parts = preg_split(NameConnector::pattern(), $fullName);
        $lastName = collect(explode(' ', trim($parts[1])))->last();

        return collect($parts)->map(function ($part) use ($lastName) {
            $part = trim($part);

            if (!str_contains($part, $lastName)) {
                return $this->parseSinglePerson($part . ' ' . $lastName);
            }

            return $this->parseSinglePerson($part);
        });
    }

    private function parseSinglePerson(string $name): HomeownerData
    {
        $parts = collect(explode(' ', trim($name)));

        $title = Title::fromString($parts->shift());
        $lastName = $parts->pop();

        $firstName = null;
        $initial = null;

        if ($parts->isNotEmpty()) {
            $firstPart = $parts->first();

            if (NamePattern::isInitial($firstPart)) {
                $initial = NamePattern::extractInitial($firstPart);
            } else {
                $firstName = $firstPart;
            }
        }

        return HomeownerData::create(
            title: $title,
            firstName: $firstName,
            initial: $initial,
            lastName: $lastName
        );
    }
}
