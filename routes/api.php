<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\detailLicenceController;

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
// Route::get('agents',[AgentController::class,'index']);
// Route::post('agents',[AgentController::class,'store'])->name('store');
// Route::get('agents/{id}',[AgentController::class,'show'])->name('show');
// Route::get('agents/{id}/edit',[AgentController::class,'edit'])->name('edit');
// Route::put('agents/{id}/edit',[AgentController::class,'update']);
// Route::delete('agents/{id}/delete', [AgentController::class,'destroy']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//travail donné hier sur les details de douanes
Route::get('details',[detailLicenceController::class,'index']);
Route::post('details',[detailLicenceController::class,'store']);
Route::get('details/{id}',[detailLicenceController::class,'show'])->name('show');
Route::get('details/{id}/edit',[detailLicenceController::class,'edit'])->name('edit');
Route::put('details/{id}/edit',[detailLicenceController::class,'update']);
Route::delete('details/{id}/delete', [detailLicenceController::class,'destroy']);

//example sur l'api avec auth
Route::get('articles',[ArticleController::class,'index']);
Route::post('ajouter',[ArticleController::class,'store']);
Route::get('articles/{article}',[ArticleController::class,'show']);
Route::get('articles/edit/{article}',[ArticleController::class,'edit']);
Route::put('articles/edit/{article}',[ArticleController::class,'update']);
Route::delete('articles/{article}',[ArticleController::class,'destroy']);