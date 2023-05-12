<?php

use App\Http\Controllers\DetailfpController;
use App\Http\Controllers\DetailFPIController;
use App\Http\Controllers\FonctionpublicController;
use App\Http\Controllers\FpiController;
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

// Routes additionnelles pour les details licences
route::prefix('details')->group(function () {
    Route::get('/', [detailLicenceController::class, 'index']);
    Route::get('restore', [detailLicenceController::class, 'restores']);
    Route::get('/search', [detailLicenceController::class, 'search']);
});
Route::get('detail/{detail}', [detailLicenceController::class, 'show'])->name('show');

// Routes addictionnelles pour les details de la FPI
Route::prefix('detailfpis')->group(function () {
    Route::get('/', [FpiController::class, 'index']);
    Route::get('/search', [FpiController::class, 'search']);
    Route::get('/restorer', [FpiController::class, 'restorerAll']);
});
Route::get('detailfpi/{id}', [FpiController::class, 'show']);

//addictionnelles de route pour les donnees du Ministere du travail 
Route::prefix('fonctions')->group(function () {
    Route::get('/', [FonctionpublicController::class, 'index']);
    Route::get('/restorer', [FonctionpublicController::class, 'restorerAll']);
    Route::get('/search', [FonctionpublicController::class, 'search']);
});
Route::get('fonction/{id}', [FonctionpublicController::class, 'show']);

//authentification 
Route::post('register', [UserController::class, 'store'])->name('store');
Route::post('login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {

    //travail donné hier sur les details de douanes

    Route::prefix('detail')->group(function () {
        Route::post('/', [detailLicenceController::class, 'store']);
        Route::put('/{id}', [detailLicenceController::class, 'update']);
        Route::delete('/{id}', [detailLicenceController::class, 'destroy']);
        Route::get('/restore/{id}', [detailLicenceController::class, 'restore']);
    });

    // Route pour les donnees de la FPI
    Route::prefix('detailfpi')->group(function () {
        Route::post('/', [FpiController::class, 'store']);
        Route::put('/{id}', [FpiController::class, 'update']);
        Route::delete('/{id}', [FpiController::class, 'destroy']);
        Route::get('/restorer/{id}', [FpiController::class, 'restorer']);
    });
    // Route pour les donnees du ministere du travail 
    Route::prefix('fonction')->group(function () {
        Route::post('/', [FonctionpublicController::class, 'store']);
        Route::put('/{id}', [FonctionpublicController::class, 'update']);
        Route::delete('/{id}', [FonctionpublicController::class, 'destroy']);
        Route::get('/restore/{id}', [FonctionpublicController::class, 'restorer']);
    }); 

    
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

// ce bout de code nous permette de renvoyer un message si la route que l'utisateur veut acceder n'existe pas
Route::fallback(
    function () {
        return response()->json(
            [
                'message' => 'Nous ne retrouvons pas la page, si l\'erreur persiste, contactez l\'Adminstrateur'
            ]
        );
    }
);