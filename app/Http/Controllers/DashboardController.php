<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Publication;
use App\Models\PublicationTraffic;
use App\Models\StructureOrganization;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count = [
            "publications" => Publication::count(),
            "structures" => StructureOrganization::count(),
            "newRegistrants" => Member::where('is_accepted_as_member', false)->where('checked', false)->count(),
            "members" => Member::where('is_accepted_as_member', true)->count()
        ];

        return view("dashboard.index", [
            "title" => "Dashboard - PKHKI",
            "count" => $count,
            "javascript" => [
                "/assets/js/chart/chart.js",
                "/assets/js/dashboard/dashboard.js"
            ]
        ]);
    }

    public function trafficStats()
    {
        $data = PublicationTraffic::select('slug')
            ->selectRaw('count(*) as total')
            ->groupBy('slug')
            ->orderByDesc('total')
            ->limit(10) // Batasi hanya 10 publikasi teratas
            ->get();

        $data = PublicationTraffic::select('publication_traffic.slug')
            ->selectRaw('count(*) as total')
            ->join('publications', 'publication_traffic.slug', '=', 'publications.slug') // Join ke tabel publications
            ->groupBy('publication_traffic.slug', 'publications.title') // Group by slug & title
            ->orderByDesc('total')
            ->limit(10) // Ambil 10 publikasi dengan kunjungan terbanyak
            ->addSelect('publications.title') // Ambil title publikasi
            ->get();

        return response()->json($data);
    }
}
