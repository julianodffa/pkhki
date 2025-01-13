<?php

use App\Http\Controllers\HomeController;
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

Route::controller(HomeController::class)->group(function (){
    Route::get("/", "pageHome");
    Route::get("/home/tentang", "pageTentang");
    Route::get("/home/struktur", "pageStruktur");
    Route::get("/home/kontak", "pageKontak");
    Route::get("/home/daftar", "pageDaftar");
});

Route::get('/dashboard', function(){
    return view("dashboard.index", ["title" => "PKHKI"]);
});