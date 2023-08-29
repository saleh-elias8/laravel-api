<?php

use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('students',[StudentController::class,'index']);
Route::post('students',[StudentController::class,'store']);
Route::get('students/{id}',[StudentController::class,'show']);
Route::get('students/{id}/edit',[StudentController::class,'edit']);
Route::put('students/{id}/edit',[StudentController::class,'update']);
Route::delete('students/{id}/delete',[StudentController::class,'destroy']);

// Route::prefix('/students')->group(function(){
//     Route::get('/', [StudentController::class, 'index']);
//     Route::post('/', [StudentController::class, 'store']);
//     Route::get('/{id}', [StudentController::class, 'show']);
//     Route::put('/{id}/edit', [StudentController::class, 'edit']);
//     Route::patch('/{id}/edit', [StudentController::class, 'update']);
//     Route::delete('/{id}/delete', [StudentController::class, 'destroy']);
// });
