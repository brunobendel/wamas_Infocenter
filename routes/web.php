<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\IntegracaoController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/teste', [TesteController::class, 'index']);

Route::get('/integracao', [IntegracaoController::class, 'index'])->name('integracao.index');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::post('/api/settings/toggle', [SettingsController::class, 'toggle'])->name('settings.toggle');
Route::post('/api/settings/server', [SettingsController::class, 'updateServerSetting'])->name('settings.server');

Route::get('/importar-excel', [ImportController::class, 'importForm']);
Route::post('/importar-excel', [ImportController::class, 'importExcel'])->name('import.excel');
