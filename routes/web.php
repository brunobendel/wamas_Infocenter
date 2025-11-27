<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\ImportController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/teste', [TesteController::class, 'index']);

Route::get('/importar-excel', [ImportController::class, 'importForm']);
Route::post('/importar-excel', [ImportController::class, 'importExcel'])->name('import.excel');
