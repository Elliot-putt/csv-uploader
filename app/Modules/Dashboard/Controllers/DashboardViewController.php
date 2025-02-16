<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Homeowner\Services\HomeownerService;
use Inertia\Inertia;
use Inertia\Response;

class DashboardViewController extends Controller {

    public function __construct(readonly protected HomeownerService $service)
    {
    }

    public function __invoke(): Response
    {
        return Inertia::render('Modules/Dashboard/Dashboard', [
            'homeowners' => $this->service->all(),
        ]);
    }

}
