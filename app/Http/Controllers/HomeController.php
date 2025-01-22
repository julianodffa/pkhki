<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\Publication;
use App\Models\Role;
use App\Models\StructureOrganization;
use Illuminate\Http\Request;
use Nette\Schema\Elements\Structure;

class HomeController extends Controller
{
    public function pageHome()
    {
        $news = Publication::whereHas('categories', function ($query) {
            $query->where('slug', 'berita');
        })->get();
        return view("home.home", [
            "title" => "Perhimpunan Konsultan Hukum Keimigrasian",
            "css" => "home",
            "news" => $news
        ]);
    }

    public function pageTentang()
    {
        return view("home.tentang", [
            "title" => "Tentang Kami",
            "css" => "tentang"
        ]);
    }

    public function pageStruktur()
    {
        return view("home.struktur", [
            "title" => "Struktur Organisasi",
            "css" => "struktur",
            "roles" => Role::all(),
            "structures" => StructureOrganization::all()->groupBy('role_id')
        ]);
    }

    public function pageAnggota()
    {
        return view("home.anggota", [
            "title" => "Anggota",
            "css" => "anggota",
            "members" => Member::where('is_accepted_as_member', true)->get()
        ]);
    }

    public function pageKontak()
    {
        return view("home.kontak", [
            "title" => "Kontak",
            "css" => "kontak"
        ]);
    }

    public function pageDaftar()
    {
        return view("home.daftar", [
            "title" => "Daftar Anggota",
            "css" => "daftar"
        ]);
    }

    public function pagePublikasi()
    {
        $publications = Publication::latest();
        if (request('s')) {
            $search = request('s');
            $publications->where('title', 'like', "%{$search}%");
        }


        $publications = $publications->with(["user", "categories"])->paginate(3);
        $categories = Category::all();
        return view("home.publikasi", [
            "title" => "Publikasi",
            "css" => "publikasi",
            "publications" => $publications,
            "categories" => $categories,
        ]);
    }

    public function publikasi(Publication $publication)
    {
        $contentHtml = file_get_contents($publication->content);
        $publication->with('user', 'categories')->get();
        $publication->increment('clicks');
        $categories = Category::all();
        return view("home.detailPublikasi", [
            "title" => $publication->title,
            "css" => "detailPublikasi",
            "publication" => $publication,
            "contentHtml" => $contentHtml,
            "categories" => $categories,

        ]);
    }

    public function pageKategori(Category $category)
    {
        // Ambil publikasi berdasarkan kategori yang dipilih
        $publications = $category->publications()->with(["user", "categories"])->orderBy('created_at', 'desc')->paginate(10);

        // Ambil semua kategori untuk filter
        $categories = Category::all();

        $title = $category->name;
        if ($category->name == "kegiatan") {
            $title = "Kegiatan";
        }

        // Kembalikan ke view dengan data yang diperlukan
        return view("home.kategori", [
            "title" => "$category->name",
            "css" => "publikasi",
            "publications" => $publications,
            "categories" => $categories,
        ]);
    }
}
