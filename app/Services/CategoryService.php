<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    protected $publicationService;

    public function __construct(PublicationService $publicationService)
    {
        $this->publicationService = $publicationService;
    }

    public function createCategory(string $name): Category
    {
        $slug = $this->publicationService->createSlug($name);

        return Category::create([
            'name' => $name,
            'slug' => $slug,
        ]);
    }

    public function updateCategory(Category $category, string $newName): bool
    {
        $slug = $this->publicationService->createSlug($newName);

        return $category->update([
            'name' => $newName,
            'slug' => $slug,
        ]);
    }

    public function canDeleteCategory(Category $category): bool
    {
        return !$category->publications()->exists();
    }

    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }
}
