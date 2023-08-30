<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RecetteController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/addRecette', [App\Http\Controllers\RecetteController::class, 'create'])->name('addRecette');
Route::post('/storeRecette', [App\Http\Controllers\RecetteController::class, 'store'])->name('storeRecette');
Route::delete('/deleteRecette/{id}', [App\Http\Controllers\RecetteController::class, 'destroy'])->name('deleteRecette');
Route::get('/editRecette/{id}', [App\Http\Controllers\RecetteController::class, 'edit'])->name('editRecette');
Route::put('/updateRecette/{id}', [App\Http\Controllers\RecetteController::class, 'update'])->name('updateRecette');

Route::get('/ajouter-commentaire/{id}', [App\Http\Controllers\CommentaireController::class, 'create'])->name('ajouterCommentaire');
Route::post('/enregistrer-commentaire/{id}', [App\Http\Controllers\CommentaireController::class, 'store'])->name('enregistrerCommentaire');
Route::get('/modifier-commentaire/{id}', [App\Http\Controllers\CommentaireController::class, 'edit'])->name('modifierCommentaire');
Route::post('/mettre-a-jour-commentaire/{id}', [App\Http\Controllers\CommentaireController::class, 'update'])->name('mettreAJourCommentaire');
Route::delete('/supprimer-commentaire/{id}', [App\Http\Controllers\CommentaireController::class, 'destroy'])->name('supprimerCommentaire');

