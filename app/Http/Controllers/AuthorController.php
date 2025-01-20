<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function create()
    {
        return response()->view('dashboard.publications.authors.create', [
            "title" => "Publications",
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:authors,name',
        ]);

        $this->authorService->createAuthor($validated['name']);

        return redirect("/dashboard/publications")->with("success-author", "New Author has been added!");
    }

    public function edit(Author $author)
    {
        return response()->view('dashboard.publications.authors.edit', [
            "title" => "Publications",
            "author" => $author,
        ]);
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:authors,name,' . $author->id,
        ]);

        $this->authorService->updateAuthor($author, $validated['name']);

        return redirect("/dashboard/publications")->with("success-author", "Author has been updated!");
    }

    public function destroy(Author $author)
    {
        $canDelete = $this->authorService->canDeleteAuthor($author);

        if (!$canDelete) {
            return redirect('/dashboard/publications/')
                ->with('error-author', 'Cannot delete this author because it is associated with one or more publications.');
        }

        $this->authorService->deleteAuthor($author);

        return redirect('/dashboard/publications/')
            ->with('success-author', 'Author has been deleted!');
    }
}
