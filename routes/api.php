<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/Person/{id}', [PersonController::class, 'get_person_with_info']);
Route::get('/Persons', [PersonController::class,'get_all_person']);
route::post('/add-new-person', [PersonController::class, 'add_new_person']);
