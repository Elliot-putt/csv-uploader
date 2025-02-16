<?php

namespace App\Modules\Homeowner\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Homeowner\Exports\HomeownerExport;
use App\Modules\Homeowner\Services\HomeownerService;
use Maatwebsite\Excel\Facades\Excel;

class HomeownerExportController extends Controller {

    public function __invoke(HomeownerService $service)
    {
        return Excel::download(new HomeownerExport, 'homeowners.xlsx');
    }

}
