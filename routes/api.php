<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XmlIntegrationController;

Route::middleware('api')->prefix('xml-integration')->group(function () {
    Route::post('/generate', [XmlIntegrationController::class, 'generateXml']);
    Route::post('/insert', [XmlIntegrationController::class, 'insertItem']);
    Route::post('/generate-batch', [XmlIntegrationController::class, 'generateBatchXml']);
    Route::post('/sql-insert', [XmlIntegrationController::class, 'generateSqlInsert']);
    Route::post('/sql-batch', [XmlIntegrationController::class, 'generateBatchSqlInsert']);
    Route::get('/list', [XmlIntegrationController::class, 'listXmls']);
    Route::get('/{xmlIntegration}', [XmlIntegrationController::class, 'getXml']);
    Route::put('/{xmlIntegration}/status', [XmlIntegrationController::class, 'updateStatus']);
    Route::get('/{xmlIntegration}/download', [XmlIntegrationController::class, 'downloadXml']);
    Route::delete('/{xmlIntegration}', [XmlIntegrationController::class, 'deleteXml']);
});
