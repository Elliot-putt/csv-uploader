<?php

namespace App\Modules\Homeowner\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Homeowner\Requests\HomeownerUploadRequest;
use App\Modules\Homeowner\Services\HomeownerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class HomeownerUploadController extends Controller {
    public function __invoke(HomeownerUploadRequest $request , HomeownerService $service) : RedirectResponse
    {
        $service->uploadHomeowners($request->all());

        return Redirect::route('dashboard')->with('success', 'Homeowners uploaded successfully.');
    }

}
