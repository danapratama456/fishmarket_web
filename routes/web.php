<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingpageController;

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

Route::get('/', [LandingpageController::class, 'index'])->name('index');

Route::get('/scan_table', [LandingpageController::class, 'scan_table'])->name('scan_table');

Route::get('/menu/{id_table}', [LandingpageController::class, 'menu'])->name('menu');


Route::get('/upload_menu', [LandingpageController::class, 'upload_menu'])->name('upload_menu');
Route::post('/upload_menu_add', [LandingpageController::class, 'upload_menu_add'])->name('upload_menu_add');
Route::post('/upload_menu_delete/{id}', [LandingpageController::class, 'upload_menu_delete'])->name('upload_menu_delete');
