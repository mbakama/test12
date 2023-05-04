<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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



Route::get('details', [detailLicenceController::class, 'index']);
Route::get('detail/{detail}', [detailLicenceController::class, 'show'])->name('show');

//authentification 
Route::post('register', [UserController::class, 'store'])->name('store');
Route::post('login', [UserController::class, 'login'])->name('login');


//example sur l'api avec auth
Route::get('articles', [ArticleController::class, 'index']);



Route::middleware('auth:sanctum')->group(function () {

    //travail donné hier sur les details de douanes
    Route::post('detail', [detailLicenceController::class, 'store']);
    // Route::get('details/{id}/edit',[detailLicenceController::class,'edit'])->name('edit');
    Route::put('detail/edit/{id}', [detailLicenceController::class, 'update']);
    Route::delete('detail/delete/{id}', [detailLicenceController::class, 'destroy']);

    // Route::post('ajouter',[ArticleController::class,'store'])->name('store');
    // Route::get('article/{article}',[ArticleController::class,'show']);
    // // Route::get('article/edit/{article}',[ArticleController::class,'edit'])->name('edit');
    // Route::put('article/edit/{article}',[ArticleController::class,'update']);
    // Route::delete('article/{article}',[ArticleController::class,'destroy']);
    // Route::get('article/restore/{article}',[ArticleController::class,'restore']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});