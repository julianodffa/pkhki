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
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Structures', 'url' => url('/dashboard/structures'), 'active' => true],
        ];

        $Structures = StructureOrganization::with(['role'])->latest()->paginate(50);
        return response()->view('dashboard.structures.index', [
            "title" => "Structures",
            'breadcrumbs' => $breadcrumbs,
            "structures" => $Structures,
            "countStructures" => StructureOrganization::count(),
            "roles" => Role::all()
        ]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Structures', 'url' => url('/dashboard/structures'), 'active' => false],
            ['label' => 'Create', 'url' => '', 'active' => true],
        ];

        $roles = Role::all();
        return response()->view('dashboard.structures.create', [
            "title" => "Structures",
            'breadcrumbs' => $breadcrumbs,
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
        ], [
            'image.dimensions' => "Image dimension must have 300px Width and 450px Height",
            'image.max' => "Max Cover size is 1MB"
        ]);

        $structureOrganization = $this->structurOrganizationService->createStructure($validated);
        $name = $validated['name'];

        return redirect("/dashboard/structures")->with("success", "$name has been added to structure!");
    }

    public function show(StructureOrganization $structureOrganization)
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Structures', 'url' => url('/dashboard/structures'), 'active' => false],
            ['label' => $structureOrganization->name, 'url' => '', 'active' => true],
        ];

        $structureOrganization->load('role');
        return response()->view('dashboard.structures.show', [
            "title" => "Structures",
            'breadcrumbs' => $breadcrumbs,
            "structure" => $structureOrganization,
        ]);
    }

    public function edit(StructureOrganization $structureOrganization)
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Structures', 'url' => url('/dashboard/structures'), 'active' => false],
            ['label' => $structureOrganization->name, 'url' => '', 'active' => true],
        ];

        $structureOrganization->with('role')->get();
        return response()->view('dashboard.structures.edit', [
            "title" => "Structures",
            'breadcrumbs' => $breadcrumbs,
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024|dimensions:width=300,height=450',
            'role_id' => 'required',
        ], [
            'image.dimensions' => "Image dimension must have 300px Width and 450px Height",
            'image.max' => "Max Cover size is 1MB"
        ]);

        $this->structurOrganizationService->updateStructure($structureOrganization, $validated);

        return redirect("/dashboard/structures")->with("success", "Structures has been updated!");
    }

    public function destroy(StructureOrganization $structureOrganization)
    {
        $this->structurOrganizationService->deleteStructure($structureOrganization);
        $name = $structureOrganization['name'];

        return redirect('/dashboard/structures')->with("success", "$name has been deleted from structure!");
    }
}
