<?php

use App\Http\Controllers\CostBenchmarkController;
use Illuminate\Support\Facades\Route;

Route::get('/freight-rates', [CostBenchmarkController::class, 'getFreightRates']);
Route::get('/duty-rate',     [CostBenchmarkController::class, 'getDutyRate']);
