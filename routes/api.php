<?php

use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\ContactController;
use App\Http\Controllers\api\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->namespace('api')->group(function () {
    Route::get('/employee/index',[EmployeeController::class, 'index'])->name('api.employee.index');
    Route::post('/employee/create', [EmployeeController::class, 'create'])->name('api.employee.create');
    Route::get('/employee/find/{id}', [EmployeeController::class, 'find'])->name('api.employee.find');
    Route::put('/employee/update/{id}', [EmployeeController::class, 'update'])->name('api.employee.update');
    Route::delete('/employee/destroy/{id}', [EmployeeController::class, 'destroy'])->name('api.employee.destroy');

});

Route::prefix('v1')->namespace('Api')->group(function () {
    Route::get('/company/index',[CompanyController::class, 'index'])->name('api.company.index');
    Route::post('/company/create', [CompanyController::class, 'create'])->name('api.company.create');
    Route::get('/company/find/{id}', [CompanyController::class, 'find'])->name('api.company.find');
    Route::put('/company/update/{id}', [CompanyController::class, 'update'])->name('api.company.update');
    Route::delete('/company/destroy/{id}', [CompanyController::class, 'destroy'])->name('api.company.destroy');

});

Route::prefix('v1')->namespace('Api')->group(function () {
    Route::get('/client/index',[ClientController::class, 'index'])->name('api.client.index');
    Route::post('/client/create', [ClientController::class, 'create'])->name('api.client.create');
    Route::get('/client/find/{id}', [ClientController::class, 'find'])->name('api.client.find');
    Route::put('/client/update/{id}', [ClientController::class, 'update'])->name('api.client.update');
    Route::delete('/client/destroy/{id}', [ClientController::class, 'destroy'])->name('api.client.destroy');

});



Route::prefix('v1')->namespace('Api')->group(function () {
    Route::get('/Address/index',[AddressController::class, 'index'])->name('api.address.index');
    Route::post('/Address/create', [AddressController::class, 'create'])->name('api.address.create');
    Route::get('/Address/find/{id}', [AddressController::class, 'find'])->name('api.address.find');
    Route::put('/Address/update/{id}', [AddressController::class, 'update'])->name('api.address.update');
    Route::delete('/Address/destroy/{id}', [AddressController::class, 'destroy'])->name('api.address.destroy');

});

Route::prefix('v1')->namespace('Api')->group(function () {
    Route::get('/Contact/index',[ContactController::class, 'index'])->name('api.contact.index');
    Route::post('/Contact/create', [ContactController::class, 'create'])->name('api.contact.create');
    Route::get('/Contact/find/{id}', [ContactController::class, 'find'])->name('api.contact.find');
    Route::put('/Contact/update/{id}', [ContactController::class, 'update'])->name('api.contact.update');
    Route::delete('/Contact/destroy/{id}', [ContactController::class, 'destroy'])->name('api.contact.destroy');

});





// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
