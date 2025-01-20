<?php

namespace App\Http\Controllers;

use App\Services\PublicationService;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    protected $publicationService;

    public function __construct(PublicationService $publicationService)
    {
        $this->publicationService = $publicationService;
    }

    public function index()
    {
        $publications = Publication::with(['author', 'categories'])->get();
        $categories = Category::all();
        $authors = Author::all();
        return response()->view('dashboard.publications.index', [
            "title" => "Publications",
            "publications" => $publications,
            "categories" => $categories,
            "authors" => $authors
        ]);
    }

    public function show(Publication $publication)
    {
        $contentHtml = file_get_contents($publication->content);
        $publication->with('author', 'categories')->get();
        return response()->view('dashboard.publications.show', [
            "title" => "Publications",
            "publication" => $publication,
            "authors" => Author::all(),
            "categories" => Category::all(),
            "contentHtml" => $contentHtml
        ]);
    }

    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('dashboard.publications.create', [
            "title" => "Publications",
            "authors" => $authors,
            "categories" => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:publications,title',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'content' => 'required',
            'author_id' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $publication = $this->publicationService->createPublication($validated);

        return redirect("/dashboard/publications")->with("success", "New Publication has been added!");
    }

    public function edit(Publication $publication)
    {
        $contentHtml = file_get_contents($publication->content);
        $publication->with('author', 'categories')->get();
        return response()->view('dashboard.publications.edit', [
            "title" => "Publications",
            "publication" => $publication,
            "authors" => Author::all(),
            "categories" => Category::all(),
            "contentHtml" => $contentHtml
        ]);
    }

    public function update(Request $request, Publication $publication)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:publications,title,' . $publication->id,
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'content' => 'required',
            'author_id' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $this->publicationService->updatePublication($publication, $validated);

        return redirect("/dashboard/publications")->with("success", "Publication has been updated!");
    }

    public function destroy(Publication $publication)
    {
        $this->publicationService->deletePublication($publication);

        return redirect('/dashboard/publications')->with("success", "Publication has been deleted!");
    }
}
