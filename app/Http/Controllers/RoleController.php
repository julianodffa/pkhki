<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function create()
    {
        return response()->view('dashboard.structures.roles.create', [
            "title" => "Structures",
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:roles,name',
        ]);

        $this->roleService->createRole($validated['name']);
        $name = $validated["name"];

        return redirect("/dashboard/structures")->with("success-role", "$name has been added!");
    }

    public function edit(Role $role)
    {
        return response()->view('dashboard.structures.roles.edit', [
            "title" => "structures",
            "role" => $role,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $role->id,
        ]);

        $this->roleService->updateRole($role, $validated['name']);

        return redirect("/dashboard/structures")->with("success-role", "Role has been updated!");
    }

    public function destroy(Role $role)
    {
        $canDelete = $this->roleService->canDeleteRole($role);

        $name = $role['name'];

        if (!$canDelete) {
            return redirect('/dashboard/structures/')
                ->with('error-role', "Cannot delete $name because it is associated with one or more structures.");
        }

        $this->roleService->deleteRole($role);

        return redirect('/dashboard/structures/')
            ->with('success-role', "$name has been deleted!");
    }
}
