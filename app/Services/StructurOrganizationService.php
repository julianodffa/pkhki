<?php

namespace App\Services;

use App\Models\StructureOrganization;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class StructurOrganizationService
{
    public function createStructure($data)
    {
        // Handle file upload dan penyimpanan konten
        $imageName = $this->uploadImage($data['image']);

        $structureOrganization = StructureOrganization::create([
            'name' => $data['name'],
            'position' => $data['position'],
            'lawfirm' => $data['lawfirm'],
            'email' => $data['email'],
            'image' => $imageName,
            'role_id' => $data['role_id']
        ]);

        return $structureOrganization;
    }

    public function updateStructure(StructureOrganization $structureOrganization, $data)
    {
        $validatedData = $data;

        if (isset($data['image'])) {
            $this->deleteOldImage($structureOrganization);
            $validatedData['image'] = $this->uploadImage($data['image']);
        }

        $structureOrganization->update($validatedData);
        return $structureOrganization;
    }

    public function deleteStructure(StructureOrganization $structureOrganization)
    {
        $this->deleteOldImage($structureOrganization);
        $structureOrganization->delete();
    }

    // Helper functions untuk handle file
    private function uploadImage($image)
    {
        $imageName = Str::random(16) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/structures/images'), $imageName);
        return 'assets/structures/images/' . $imageName;
    }

    private function deleteOldImage(StructureOrganization $structureOrganization)
    {
        $imagePath = public_path($structureOrganization->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }
}
