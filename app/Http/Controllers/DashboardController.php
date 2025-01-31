<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Publication;
use App\Models\StructureOrganization;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count = [
            "publications" => Publication::count(),
            "structures" => StructureOrganization::count(),
            "registrants" => Member::where('is_accepted_as_member', false)->count(),
            "members" => Member::where('is_accepted_as_member', true)->count()
        ];
        
        return view("dashboard.index", [
            "title" => "Dashboard - PKHKI",
            "count" => $count
        ]);
    }
}
