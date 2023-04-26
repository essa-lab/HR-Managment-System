<?php


use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController as RegisterController;
use App\Http\Controllers\API\JobsController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\EmployeeStatusController;
use App\Http\Controllers\API\LogsController;

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
Route::get('search',[EmployeeController::class,'search']);
Route::controller(RegisterController::class)->group(function(){

    Route::post('register', 'register');
    Route::post('login', 'login');

});
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('jobs', JobsController::class);
    Route::resource('emp', EmployeeController::class);
    Route::resource('employee', EmployeeStatusController::class);

    Route::get('employees/{id}/managers',[EmployeeStatusController::class, 'getManagers']);
    Route::get('employees/{id}/managers-salary',[EmployeeStatusController::class, 'getManagersSalary']);
    Route::get('employees/search',[EmployeeStatusController::class, 'searchQuery']);

    Route::get('{date}/logs',[LogsController::class,'showLog']);

    Route::get('/employees/export',[EmployeeController::class,'exportEmployee']);

    Route::post('/employees/import',[EmployeeController::class,'imoortEmployee']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
