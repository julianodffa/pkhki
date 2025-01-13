<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicationController;
use App\Models\Category;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(HomeController::class)->group(function () {
    Route::get("/", "pageHome");
    Route::get("/home/tentang", "pageTentang");
    Route::get("/home/struktur", "pageStruktur");
    Route::get("/home/kontak", "pageKontak");
    Route::get("/home/daftar", "pageDaftar");
});

Route::get('/dashboard', function () {
    return view("dashboard.index", ["title" => "PKHKI"]);
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/dashboard/publications/categories/create', 'create');
    Route::post('/dashboard/publications/categories', 'store');
    Route::get('/dashboard/publications/categories/{category}/edit', 'edit');
    Route::put('/dashboard/publications/categories/{category}', 'update');
    Route::delete('/dashboard/publications/categories/{category}', 'destroy');
});

Route::controller(AuthorController::class)->group(function () {
    Route::get('/dashboard/publications/authors/create', 'create');
    Route::post('/dashboard/publications/authors', 'store');
    Route::get('/dashboard/publications/authors/{author}/edit', 'edit');
    Route::put('/dashboard/publications/authors/{author}', 'update');
    Route::delete('/dashboard/publications/authors/{author}', 'destroy');
});

Route::controller(PublicationController::class)->group(function () {
    Route::get('/dashboard/publications', 'index');
    Route::get('/dashboard/publications/create', 'create');
    Route::post('/dashboard/publications', 'store');
    Route::get('/dashboard/publications/{publication}', 'show');
    Route::get('/dashboard/publications/{publication}/edit', 'edit');
    Route::put('/dashboard/publications/{publication}', 'update');
    Route::delete('/dashboard/publications/{publication}', 'destroy');
});
