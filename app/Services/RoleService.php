<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Str;

class RoleService
{
    protected $publicationService;

    public function __construct(PublicationService $publicationService)
    {
        $this->publicationService = $publicationService;
    }

    public function createRole(string $name): Role
    {
        $slug = $this->publicationService->createSlug($name);

        return Role::create([
            'name' => $name,
            'slug' => $slug,
        ]);
    }

    public function updateRole(Role $role, string $newName): bool
    {
        $slug = $this->publicationService->createSlug($newName);

        return $role->update([
            'name' => $newName,
            'slug' => $slug,
        ]);
    }

    public function canDeleteRole(Role $role): bool
    {
        return !$role->structureOrganizations()->exists();
    }

    public function deleteRole(Role $role): void
    {
        $role->delete();
    }
}
