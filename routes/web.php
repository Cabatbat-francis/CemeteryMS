<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix("/person")->group(function () {
    Route::get('/', [App\Http\Controllers\PersonController::class, "getSelf"])->name('web-person-self');
    Route::post('/', [App\Http\Controllers\PersonController::class, "createSelf"])->name('web-person-create-self');
    Route::patch('/', [App\Http\Controllers\PersonController::class, "updateSelf"])->name('web-person-update-self');
    Route::delete('/', [App\Http\Controllers\PersonController::class, "deleteSelf"])->name('web-person-delete-self');
});
Route::middleware(['auth'])->prefix("/burial")->group(function () {
    Route::get("/avail/{id}", [App\Http\Controllers\BurialController::class, "AvailBurial"])->name("availburial");
});
Route::middleware(['auth'])->prefix("/corpse")->group(function () {
    Route::post("/", [App\Http\Controllers\CorpseController::class, "create"])->name("corpse-create");
    Route::patch("/{id}", [App\Http\Controllers\CorpseController::class, "patch"])->name("corpse-patch");
    Route::get("/{id}", [App\Http\Controllers\CorpseController::class, "edit"])->name("corpse-edit");
    Route::get("/", [App\Http\Controllers\CorpseController::class, "index"])->name("corpse-index");
});
Route::middleware(['auth'])->patch("validate", [App\Http\Controllers\CorpseController::class, "validateCorpse"])->name("corpse-validate");
Route::middleware(['auth'])->patch("move", [App\Http\Controllers\CorpseController::class, "moveCorpse"])->name("corpse-move");
