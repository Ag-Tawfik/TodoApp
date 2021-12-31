<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get("/todos", [TodoController::class, "index"]);
Route::post("/todo", [TodoController::class, "store"]);
Route::get("/todo/{id}", [TodoController::class, "show"]);
Route::put("/todo/{id}", [TodoController::class, "update"]);
Route::delete("/todo/{id}", [TodoController::class, "destroy"]);

Route::get("/tasks", [TaskController::class, "index"]);
Route::post("/task", [TaskController::class, "store"]);
Route::get("/task/{id}", [TaskController::class, "show"]);
Route::put("/task/{id}", [TaskController::class, "update"]);
Route::delete("/task/{id}", [TaskController::class, "destroy"]);