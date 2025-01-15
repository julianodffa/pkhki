<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\StructureOrganization;
use App\Services\StructurOrganizationService;
use Illuminate\Http\Request;

class StructureOrganizationController extends Controller
{
    protected $structurOrganizationService;

    public function __construct(StructurOrganizationService $structurOrganizationService)
    {
        $this->structurOrganizationService = $structurOrganizationService;
    }

    public function index()
    {
        $Structures = StructureOrganization::all();
        return response()->view('dashboard.structures.index', [
            "title" => "Structures",
            "structures" => $Structures,
            "roles" => Role::all()
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return response()->view('dashboard.structures.create', [
            "title" => "Structures",
            "roles" => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'lawfirm' => 'required|max:255',
            'email' => 'required|email:dns|unique:structure_organizations,email',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024|dimensions:width=300,height=450',
            'role_id' => 'required',
        ]);

        $structureOrganization = $this->structurOrganizationService->createStructure($validated);

        return redirect("/dashboard/structures")->with("success", "New Team has been added!");
    }

    public function show(StructureOrganization $structureOrganization)
    {
        $structureOrganization->with('role')->get();
        return response()->view('dashboard.structures.show', [
            "title" => "Structures",
            "structure" => $structureOrganization,
            "roles" => Role::all(),
        ]);
    }

    public function edit(StructureOrganization $structureOrganization)
    {
        $structureOrganization->with('role')->get();
        return response()->view('dashboard.structures.edit', [
            "title" => "Structures",
            "structure" => $structureOrganization,
            "roles" => Role::all(),
        ]);
    }

    public function update(Request $request, StructureOrganization $structureOrganization)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'lawfirm' => 'required|max:255',
            'email' => 'required|email:dns|unique:structure_organizations,email,' . $structureOrganization->id,
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024|dimensions:width=300,height=450',
            'role_id' => 'required',
        ]);

        $this->structurOrganizationService->updateStructure($structureOrganization, $validated);

        return redirect("/dashboard/structures")->with("success", "Structures has been updated!");
    }

    public function destroy(StructureOrganization $structureOrganization)
    {
        $this->structurOrganizationService->deleteStructure($structureOrganization);

        return redirect('/dashboard/structures');
    }
}
