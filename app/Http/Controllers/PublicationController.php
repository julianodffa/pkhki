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
        $publications = Publication::latest();

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Publications', 'url' => url('/dashboard/publications'), 'active' => true],
        ];

        if (request('s')) {
            $search = request('s');
            $publications->where('title', 'like', "%{$search}%");
        }

        $publications = $publications->with(['user', 'categories'])->paginate(50);
        $categories = Category::all();
        return response()->view('dashboard.publications.index', [
            "title" => "Publications",
            "css" => "publications",
            "js" => "publications",
            'breadcrumbs' => $breadcrumbs,
            "publications" => $publications,
            "categories" => $categories
        ]);
    }

    public function show(Publication $publication)
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Publications', 'url' => url('/dashboard/publications'), 'active' => false],
            ['label' => $publication->title, 'url' => '', 'active' => true],
        ];

        $contentHtml = file_get_contents($publication->content);
        $publication->load('user', 'categories');
        return response()->view('dashboard.publications.show', [
            "title" => "Publications",
            "css" => "detailPublication",
            'breadcrumbs' => $breadcrumbs,
            "publication" => $publication,
            "contentHtml" => $contentHtml
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Publications', 'url' => url('/dashboard/publications'), 'active' => false],
            ['label' => 'Create', 'url' => '', 'active' => true],
        ];

        return response()->view('dashboard.publications.create', [
            "title" => "Publications",
            'breadcrumbs' => $breadcrumbs,
            "categories" => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:publications,title',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:1024|dimensions:ratio=16/9',
            'content' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ], [
            'cover.dimensions' => "Image Ratio Must be 16/9, for example 1920x1080 (FHD) or 1280x720 (HD)",
            'cover.max' => "Max Cover size is 2MB"
        ]);

        $validated['user_id'] = auth()->id();

        $publication = $this->publicationService->createPublication($validated);

        return redirect("/dashboard/publications")->with("success", "New Publication has been added!");
    }

    public function edit(Publication $publication)
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Publications', 'url' => url('/dashboard/publications'), 'active' => false],
            ['label' => $publication->title, 'url' => '', 'active' => true],
        ];

        $contentHtml = file_get_contents($publication->content);
        $publication->with('user', 'categories')->get();
        return response()->view('dashboard.publications.edit', [
            "title" => "Publications",
            'breadcrumbs' => $breadcrumbs,
            "publication" => $publication,
            "categories" => Category::all(),
            "contentHtml" => $contentHtml
        ]);
    }

    public function update(Request $request, Publication $publication)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:publications,title,' . $publication->id,
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:1024|dimensions:ratio=16/9',
            'content' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ], [
            'cover.dimensions' => "Image Ratio Must be 16/9, for example 1920x1080 (FHD) or 1280x720 (HD)",
            'cover.max' => "Max Cover size is 2MB"
        ]);

        $validated['user_id'] = auth()->id();

        $this->publicationService->updatePublication($publication, $validated);

        return redirect("/dashboard/publications")->with("success", "Publication has been updated!");
    }

    public function destroy(Publication $publication)
    {
        $this->publicationService->deletePublication($publication);

        return redirect('/dashboard/publications')->with("success", "Publication has been deleted!");
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->get('query');
        $suggestions = Publication::where('title', 'like', "%{$query}%")
            ->limit(10)
            ->orderByDesc('clicks')
            ->pluck('title');

        return response()->json($suggestions);
    }
}
