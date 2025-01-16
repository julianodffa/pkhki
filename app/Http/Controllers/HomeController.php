<?php

namespace App\Http\Controllers;

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
}
