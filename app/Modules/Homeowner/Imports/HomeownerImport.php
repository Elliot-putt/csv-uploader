<?php

namespace App\Modules\Homeowner\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class HomeownerImport implements ToCollection, WithHeadingRow
{
    use Importable;

    private Collection $importedRows;

    public function __construct()
    {
        $this->importedRows = new Collection();
    }

    public function collection(Collection $rows): void
    {
        $this->importedRows = collect(['homeowners' => $rows]);
    }

}
