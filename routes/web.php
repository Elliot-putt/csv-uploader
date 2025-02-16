<?php

use App\Modules\Dashboard\Controllers\DashboardViewController;
use App\Modules\Homeowner\Controllers\HomeownerUploadController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', DashboardViewController::class)->name('dashboard');
Route::post('/homeowners/upload', HomeownerUploadController::class);
