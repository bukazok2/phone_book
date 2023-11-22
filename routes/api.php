<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\EmailController;

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
route::post('/add-new-phone_number', [PhoneController::class, 'add_new_phone']);
route::post('/add-new-email', [EmailController::class, 'add_new_email']);

route::post('/edit-person/{id}', [PersonController::class, 'edit_person']);
Route::put('/edit-phone_number/{id}', [PhoneController::class, 'edit_phone']);
Route::put('/edit-email/{id}', [EmailController::class, 'edit_email']);

route::delete('/delete-phone_number/{id}', [PhoneController::class, 'delete_phone']);
route::delete('/delete-email/{id}', [EmailController::class, 'delete_email']);
route::delete('/delete-person/{id}', [PersonController::class, 'delete_person']);

