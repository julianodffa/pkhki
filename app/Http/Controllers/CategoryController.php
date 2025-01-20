<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create()
    {
        return response()->view('dashboard.publications.categories.create', [
            "title" => "Publications",
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories,name',
        ]);

        $this->categoryService->createCategory($validated['name']);

        return redirect("/dashboard/publications")->with("success-category", "New Category has been added!");
    }

    public function edit(Category $category)
    {
        return response()->view('dashboard.publications.categories.edit', [
            "title" => "Publications",
            "category" => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
        ]);

        $this->categoryService->updateCategory($category, $validated['name']);

        return redirect("/dashboard/publications")->with("success-category", "Category has been updated!");
    }

    public function destroy(Category $category)
    {
        $canDelete = $this->categoryService->canDeleteCategory($category);

        if (!$canDelete) {
            return redirect('/dashboard/publications')
                ->with('error-category', 'Cannot delete this category because it is associated with one or more publications.');
        }

        $this->categoryService->deleteCategory($category);

        return redirect('/dashboard/publications')
            ->with('success-category', 'Category has been deleted!');
    }
}
