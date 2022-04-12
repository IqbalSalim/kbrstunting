<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ExportKeluargaController;
use App\Http\Livewire\Import\IndexImport;
use App\Http\Livewire\Rekapan\IndexRekapan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/import', IndexImport::class)->name('import');
    Route::get('/rekapan', IndexRekapan::class)->name('rekapan');
    Route::post('/export', [ExportKeluargaController::class, 'index'])->name('export-keluarga');
});

require __DIR__ . '/auth.php';
