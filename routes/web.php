<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\individual_pu;
use App\Http\Controllers\All_polling_result;
use App\Http\Controllers\New_polling_units;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/IndividualPU', [individual_pu::class, 'index'])->name('IndividualPU');
Route::get('/IndividualPU/{id}', [individual_pu::class, 'fetch_by_pu'])->name('Pu_result');
Route::get('/AllpolingResult', [All_polling_result::class, 'getAllpollingResult'])->name('AllpolingResult');
// Route::get('/AllpolingResultbypu/{id}', [All_polling_result::class, 'get_All_polling_Result_by_pu'])->name('AllpolingResultbypu');
Route::get('/AllpolingResultbypu/{id}', [All_polling_result::class, 'get_result'])->name('AllpolingResultbypu');
Route::get('/AddpolingUnitResult', [New_polling_units::class, 'index'])->name('AddpolingUnitResult');