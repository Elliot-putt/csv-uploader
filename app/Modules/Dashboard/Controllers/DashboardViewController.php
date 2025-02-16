<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class DashboardViewController extends Controller {

    public function __invoke() : Response
    {
        return Inertia::render('Modules/Dashboard/Dashboard');
    }

}
