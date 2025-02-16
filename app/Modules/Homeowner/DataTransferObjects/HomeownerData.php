<?php

namespace App\Modules\Homeowner\DataTransferObjects;

use App\Modules\Homeowner\Enums\Title;
use Illuminate\Contracts\Support\Arrayable;

class HomeownerData implements Arrayable
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $firstName,
        public readonly ?string $initial,
        public readonly string $lastName,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            firstName: $data['first_name'] ?? null,
            initial: $data['initial'] ?? null,
            lastName: $data['last_name']
        );
    }

    public static function create(
        Title $title,
        ?string $firstName,
        ?string $initial,
        string $lastName
    ): self {
        return new self(
            title: $title->value,
            firstName: $firstName,
            initial: $initial,
            lastName: $lastName
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'first_name' => $this->firstName,
            'initial' => $this->initial,
            'last_name' => $this->lastName,
        ];
    }
}
