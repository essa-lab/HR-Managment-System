<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController as RegisterController;
use App\Http\Controllers\API\JobsController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\EmployeeStatusController;

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
Route::controller(RegisterController::class)->group(function(){

    Route::post('register', 'register');
    Route::post('login', 'login');

});
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('jobs', JobsController::class);
    Route::resource('emp', EmployeeController::class);
    Route::resource('employee', EmployeeStatusController::class);

    Route::get('employee/{id}/managers',[EmployeeStatusController::class, 'getManagers']);
    Route::get('employee/{id}/managers-salary',[EmployeeStatusController::class, 'getManagersSalary']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
