<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StructureOrganizationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->name("login")->middleware("guest");
    Route::post('/login', 'authenticate')->middleware("guest");
});

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
        Route::get('/dashboard/publications/{publication:slug}', 'show');
        Route::get('/dashboard/publications/{publication:slug}/edit', 'edit');
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

    Route::get('/member/file/{folder}/{filename}', function ($folder, $filename) {
        // Menentukan path file berdasarkan folder dan filename
        $filePath = "members/$folder/$filename";  // Sesuaikan dengan struktur folder yang ada di storage

        // Memeriksa apakah file ada di dalam storage
        if (Storage::exists($filePath)) {
            // Mengembalikan file sebagai response
            return response()->file(Storage::path($filePath));
        }

        // Jika file tidak ditemukan, tampilkan halaman error 404
        abort(404);
    })->name("member.file");
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

Route::get('/dashboard', [DashboardController::class, "index"])->middleware(['auth', 'role:admin,superadmin']);

Route::post('/memberRegister', [MemberController::class, "store"]);
Route::get('/search-suggestions', [PublicationController::class, 'searchSuggestions'])->name('search.suggestions');

Route::controller(HomeController::class)->group(function () {
    Route::get("/", "pageHome");
    Route::get("/tentang-kami", "pageTentang");
    Route::get("/struktur", "pageStruktur");
    // Route::get("/kode-etik", "pageKodeEtik");
    Route::get("/anggota", "pageAnggota");
    Route::get("/kontak", "pageKontak");
    Route::get("/daftar-anggota", "pageDaftar");
    Route::get("/publikasi", "pagePublikasi");
    Route::get("/kategori/{category:slug}", "pageKategori");
    Route::get("/{publication:slug}", "publikasi");
});
