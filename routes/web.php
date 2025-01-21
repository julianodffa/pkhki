<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StructureOrganizationController;
use App\Http\Controllers\UserController;
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
    Route::get("/tentang-kami", "pageTentang");
    Route::get("/struktur", "pageStruktur");
    // Route::get("/kode-etik", "pageKodeEtik");
    // Route::get("/anggota", "pageAnggota");
    // Route::get("/publikasi", "pagePublikasi");
    // Route::get("/kegiatan", "pageKegiatan");
    Route::get("/kontak", "pageKontak");
    Route::get("/daftar-anggota", "pageDaftar");
    Route::get("/berita", "pageBerita");
    Route::get("/kegiatan", "pageKegiatan");
});

Route::get('/dashboard', function () {
    return view("dashboard.index", ["title" => "PKHKI"]);
})->middleware(['auth', 'role:admin,superadmin']);

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->name("login")->middleware("guest");
    Route::post('/login', 'authenticate')->middleware("guest");
});

Route::post('/memberRegister', [MemberController::class, "store"]);



// Role Admin or Superadmin
Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
    // Category Routes
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/dashboard/publications/categories/create', 'create');
        Route::post('/dashboard/publications/categories', 'store');
        Route::get('/dashboard/publications/categories/{category}/edit', 'edit');
        Route::put('/dashboard/publications/categories/{category}', 'update');
        Route::delete('/dashboard/publications/categories/{category}', 'destroy');
    });

    // Publication Routes
    Route::controller(PublicationController::class)->group(function () {
        Route::get('/dashboard/publications', 'index');
        Route::get('/dashboard/publications/create', 'create');
        Route::post('/dashboard/publications', 'store');
        Route::get('/dashboard/publications/{publication}', 'show');
        Route::get('/dashboard/publications/{publication}/edit', 'edit');
        Route::put('/dashboard/publications/{publication}', 'update');
        Route::delete('/dashboard/publications/{publication}', 'destroy');
    });

    // Role Routes (Structure Organizations)
    Route::controller(RoleController::class)->group(function () {
        Route::get('/dashboard/structures/roles/create', 'create');
        Route::post('/dashboard/structures/roles', 'store');
        Route::get('/dashboard/structures/roles/{role}/edit', 'edit');
        Route::put('/dashboard/structures/roles/{role}', 'update');
        Route::delete('/dashboard/structures/roles/{role}', 'destroy');
    });

    // Structure Organization Routes
    Route::controller(StructureOrganizationController::class)->group(function () {
        Route::get('/dashboard/structures', 'index');
        Route::get('/dashboard/structures/create', 'create');
        Route::post('/dashboard/structures', 'store');
        Route::get('/dashboard/structures/{structureOrganization}', 'show');
        Route::get('/dashboard/structures/{structureOrganization}/edit', 'edit');
        Route::put('/dashboard/structures/{structureOrganization}', 'update');
        Route::delete('/dashboard/structures/{structureOrganization}', 'destroy');
    });

    // Members Routes
    Route::controller(MemberController::class)->group(function () {
        Route::get('/dashboard/registrants', 'registrants');
        Route::get('/dashboard/registrants/{member}', 'show');
        Route::delete('/dashboard/members/{member}', 'destroy');
        Route::get('/dashboard/members', 'members');
        Route::put('/dashboard/members/{member}/acceptAsMember', 'acceptAsMember');
        Route::put('/dashboard/members/{member}/returnAsRegistrant', 'returnAsRegistrant');
        Route::get('/dashboard/members/{member}', 'show');
    });

    // Users Routes
    Route::controller(UserController::class)->group(function () {
        Route::get("/logout", "logout");
        Route::post("/logout", "logout");
        Route::get("/dashboard/users/{user:username}/change-password", "changePassword");
        Route::post("/dashboard/users/{user:username}/change-password", "doChangePassword");
    });
});

// Role Super Admin
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    // Users
    Route::controller(UserController::class)->group(function () {
        Route::get("/dashboard/users", "index");
        Route::get("/dashboard/users/create", "register");
        Route::post("/dashboard/users/create", "store");
        Route::delete("/dashboard/users/{user}", "destroy");
    });
});
