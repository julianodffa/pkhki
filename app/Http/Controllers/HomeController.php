<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function pageHome()
    {
        return view("home.home", [
            "title" => "Home",
            "css" => "home"
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
            "title" => "Dewan Kehormatan",
            "css" => "struktur"
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
