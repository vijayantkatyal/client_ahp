<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

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

Route::get('/', [AccountController::class, 'getIndex'])->name('get_index');
Route::get('/about', [AccountController::class, 'getAbout'])->name('get_about');
Route::get('/contact', [AccountController::class, 'getContact'])->name('get_contact');
Route::get('/events', [AccountController::class, 'getEvents'])->name('get_events');
Route::get('/forms', [AccountController::class, 'getForms'])->name('get_forms');

Route::get('/mission', [AccountController::class, 'getMission'])->name('get_mission');

Route::get('/team', [AccountController::class, 'getTeam'])->name('get_team');
Route::get('/gallery', [AccountController::class, 'getGallery'])->name('get_gallery');