<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DocteurController;
use App\Http\Controllers\PatientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('agents',[AgentController::class,'index'])->name('agents');
Route::get('agents/ajouter',[AgentController::class,'create'])->name('create');
Route::post('agents/ajouter',[AgentController::class,'store'])->name('store');
Route::get('agents/voir/{agent}',[AgentController::class,'show'])->name('show');
Route::get('agents/effacer/{agent}',[AgentController::class,'destroy'])->name('destroy');

Route::get('agents/editer/{agent}',[AgentController::class,'edit'])->name('edit');
Route::post('agents/editer/{agent}',[AgentController::class,'update'])->name('update');

Route::get('agents/restore', [AgentController::class,'restore'])->name('restore');
Route::get('agents/restored/{id}', [AgentController::class,'restored'])->name('restored');





Route::get('patients', [PatientController::class, 'index'])->name('patients.index');
Route::get('patients/envoyer',[PatientController::class,'create'])->name('patients.create');
Route::post('patients/envoyer',[PatientController::class,'store'])->name('patients.store');
Route::get('patients/voir/{patient}', [PatientController::class, 'show'])->name('patients.voir');
Route::get('patients/edit/{patient}',[PatientController::class,'edit'])->name('patients.edit');
Route::put('patients/edit/{patient}', [PatientController::class,'update'])->name('patients.update');
Route::delete('patients/effacer/{patient}', [PatientController::class,'destroy'])->name('patients.effacer');
Route::get('docteurs',[DocteurController::class, 'index'])->name('docteurs.index')->name('index');
Route::get('docteurs/repondre/{id}',[DocteurController::class,'repondre'])->name('docteurs.repondre');
Route::post('docteurs/repondre/{id}',[DocteurController::class,'reponse'])->name('docteurs.reponse');