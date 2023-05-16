<?php



use App\Http\Controllers\FonctionpublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FpiController;
use App\Http\Controllers\UserController;
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

//authentification 
Route::post('register', [UserController::class, 'store'])->name('store');
Route::post('login', [UserController::class, 'login'])->name('login');

// Routes additionnelles pour les details licences
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/details', [detailLicenceController::class, 'index']);
    Route::get('/detail/{id}', [detailLicenceController::class, 'show'])->name('show');
    Route::post('/detail', [detailLicenceController::class, 'store']);
    Route::put('/detail/{id}', [detailLicenceController::class, 'update']);
    Route::delete('/detail/{id}', [detailLicenceController::class, 'destroy']);

    Route::get('reconveries', [detailLicenceController::class, 'restores']);
    Route::get('/recherche', [detailLicenceController::class, 'search']);
    Route::get('/all_data', [detailLicenceController::class, 'all_data']);
    Route::get('/reconvery/{id}', [detailLicenceController::class, 'restore']);

    // Routes addictionnelles pour les details de la FPI

    Route::get('/detailfpis', [FpiController::class, 'index']);
    Route::get('/detailfpi/{id}', [FpiController::class, 'show']);
    Route::post('/detailfpi', [FpiController::class, 'store']);
    Route::put('/detailfpi/{id}', [FpiController::class, 'update']);
    Route::delete('/detailfpi/{id}', [FpiController::class, 'destroy']);

    Route::get('/reconverys', [FpiController::class, 'restorerAll']);
    Route::get('/reconvery/{id}', [FpiController::class, 'restorer']);
    Route::get('/recherche', [FpiController::class, 'search']);
    Route::get('/all_data', [FpiController::class, 'all_data']);

    //addictionnelles de route pour les donnees du Ministere du travail 

    Route::get('/fonctions', [FonctionpublicController::class, 'index']);
    Route::get('/fonction/{id}', [FonctionpublicController::class, 'show']);
    Route::post('/fonction', [FonctionpublicController::class, 'store']);
    Route::put('/fonction/{id}', [FonctionpublicController::class, 'update']);
    Route::delete('/fonction/{id}', [FonctionpublicController::class, 'destroy']);

    Route::get('/reconvery/{id}', [FonctionpublicController::class, 'restorer']);
    Route::get('/reconverys', [FonctionpublicController::class, 'restorerAll']);
    Route::get('/recherche', [FonctionpublicController::class, 'search']);
    Route::get('/all_data', [FonctionpublicController::class, 'all_data']);

    Route::post('/up', [FonctionpublicController::class, 'uploader']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});





// ce bout de code nous permette de renvoyer un message si la route que l'utisateur veut acceder n'existe pas
Route::fallback(
    function () {
        return response()->json(
            [
                'error' => 'Nous ne retrouvons pas la page que vous avez demandé, si l\'erreur persiste, contactez l\'Adminstrateur'
            ],
            404
        );
    }
);