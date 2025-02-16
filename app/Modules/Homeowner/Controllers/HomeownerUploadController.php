<?php

namespace App\Modules\Homeowner\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Redirect;

class HomeownerUploadController extends Controller {

    public function __invoke() : RedirectResponse
    {
        return Redirect::route('dashboard')->with('success', 'Homeowners uploaded successfully.');
    }

}
