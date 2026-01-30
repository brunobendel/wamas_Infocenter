<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\IntegracaoController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index']);

Route::get('/teste', [TesteController::class, 'index']);

Route::get('/integracao', [IntegracaoController::class, 'index'])
    ->name('integracao.index')
    ->middleware(['auth', \App\Http\Middleware\EnsureAdmin::class]);

// Authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
    ]);
})->middleware('guest');

Route::post('/logout', function (Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/register', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']]);

    return redirect('/');
})->middleware('guest');

Route::middleware(['auth', \App\Http\Middleware\EnsureAdmin::class])->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/api/settings/toggle', [SettingsController::class, 'toggle'])->name('settings.toggle');
    Route::post('/api/settings/server', [SettingsController::class, 'updateServerSetting'])->name('settings.server');
    Route::post('/api/settings/permission', [SettingsController::class, 'setPermission'])->name('settings.permission');
});

Route::middleware(['auth', \App\Http\Middleware\EnsureAdmin::class])->group(function () {
    Route::get('/importar-excel', [ImportController::class, 'importForm']);
    Route::post('/importar-excel', [ImportController::class, 'importExcel'])->name('import.excel');
});
