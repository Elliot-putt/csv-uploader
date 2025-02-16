<?php

namespace App\Modules\Homeowner\Services;

use App\Modules\Homeowner\Imports\HomeownerImport;
use App\Modules\Homeowner\Models\Homeowner;
use Illuminate\Support\Collection;

class HomeownerService {

    public function all(): Collection
    {
        return Homeowner::all();
    }

    public function uploadHomeowners(array $data): void
    {
        $file = array_get($data, 'file');
        $parsedHomeowners = $this->reduceHomeowners($this->importHomeowners($file));

        $this->storeMany($parsedHomeowners->toArray());
    }

    public function storeMany(array $data) : void
    {
        Homeowner::upsert(
            $data,
            [],
            ['title', 'first_name', 'initial', 'last_name']
        );
    }

    public function importHomeowners($file): Collection
    {
        return (new HomeownerImport())->toCollection($file)->first();
    }

    public function reduceHomeowners (Collection $homeownersCollection): Collection
    {
        return (new Homeowner)->parseNames(
            $homeownersCollection->pluck('homeowner')->filter()
        );
    }


}
