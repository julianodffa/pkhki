<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\Publication;
use App\Models\Role;
use App\Models\StructureOrganization;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function pageHome()
    {
        $news = Publication::whereHas('categories', function ($query) {
            $query->where('slug', 'berita');
        })->get();

        return view("home.home", [
            "title" => "Perhimpunan Konsultan Hukum Keimigrasian",
            "news" => $news,
            "css" => ["/assets/css/home/home.css"]
        ]);
    }

    public function pageTentang()
    {
        return view("home.tentang", [
            "title" => "Tentang Kami",
            "css" => ["/assets/css/home/tentang.css"]
        ]);
    }

    public function pageStruktur()
    {
        return view("home.struktur", [
            "title" => "Struktur Organisasi",
            "roles" => Role::all(),
            "structures" => StructureOrganization::all()->groupBy('role_id'),
            "css" => ["/assets/css/home/struktur.css"]
        ]);
    }

    public function pageAnggota()
    {
        return view("home.anggota", [
            "title" => "Anggota",
            "members" => Member::latest()->where('is_accepted_as_member', true)->get(),
            "css" => ["/assets/css/home/anggota.css"]
        ]);
    }

    public function pageKontak()
    {
        return view("home.kontak", [
            "title" => "Kontak",
            "css" => ["/assets/css/home/kontak.css"]
        ]);
    }

    public function pageDaftar()
    {
        return view("home.daftar", [
            "title" => "Daftar Anggota",
            "css" => ["/assets/css/home/daftar.css"]
        ]);
    }

    public function pagePublikasi()
    {
        $publications = Publication::latest();
        if (request('s')) {
            $search = request('s');
            $publications->where('title', 'like', "%{$search}%");
        }

        $publications = $publications->with(["user", "categories"])->paginate(20);
        $categories = Category::all();

        return view("home.publikasi", [
            "title" => "Publikasi",
            "publications" => $publications,
            "categories" => $categories,
            "css" => ["/assets/css/home/publikasi.css"],
            "javascript" => [
                "assets/js/jquery/jquery-3.7.1.min.js",
                "/assets/js/home/publikasi.js"
            ]
        ]);
    }

    public function publikasi(Publication $publication)
    {
        $publication->load('user', 'categories');
        $contentHtml = file_get_contents($publication->content);
        $publication->increment('clicks');
        $categories = Category::all();

        return view("home.detailPublikasi", [
            "title" => $publication->title,
            "publication" => $publication,
            "contentHtml" => $contentHtml,
            "categories" => $categories,
            "css" => ["/assets/css/both/detailPublication.css"]
        ]);
    }

    public function pageKategori(Category $category)
    {
        $publications = $category->publications()->with(["user", "categories"])->orderBy('created_at', 'desc')->paginate(20);
        $categories = Category::all();
        $title = $category->name == "kegiatan" ? "Kegiatan" : $category->name;

        return view("home.kategori", [
            "title" => $title,
            "publications" => $publications,
            "categories" => $categories,
            "css" => ["/assets/css/home/kategori.css"]
        ]);
    }
}
