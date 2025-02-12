<?php

namespace App\Http\Controllers;

use App\Services\PublicationService;
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
            ['label' => 'Publications', 'url' => url('/dashboard/publications'), 'active' => true]
        ];

        if (request('s')) {
            $search = request('s');
            $publications->where('title', 'like', "%{$search}%");
        }

        $publications = $publications->with(['user', 'categories'])->paginate(50);
        $categories = Category::all();
        return response()->view('dashboard.publications.index', [
            "title" => "Publications",
            'breadcrumbs' => $breadcrumbs,
            "publications" => $publications,
            "countPublications" => Publication::count(),
            "categories" => $categories,
            "css" => ['/assets/css/dashboard/publications.css'],
            "javascript" => [
                "/assets/js/sweetalert/sweetalert.js",
                "/assets/js/sweetalert/sweetalert-trigger.js",
                "/assets/js/dashboard/publications.js"
            ]
        ]);
    }

    public function show(Publication $publication)
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Publications', 'url' => url('/dashboard/publications'), 'active' => false],
            ['label' => $publication->title, 'url' => '', 'active' => true]
        ];

        $contentHtml = file_get_contents($publication->content);
        $publication->load('user', 'categories');
        return response()->view('dashboard.publications.show', [
            "title" => "Publications",
            'breadcrumbs' => $breadcrumbs,
            "publication" => $publication,
            "contentHtml" => $contentHtml,
            "css" => ["/assets/css/both/detailPublication.css"]
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Publications', 'url' => url('/dashboard/publications'), 'active' => false],
            ['label' => 'Create', 'url' => '', 'active' => true]
        ];

        return response()->view('dashboard.publications.create', [
            "title" => "Publications",
            'breadcrumbs' => $breadcrumbs,
            "categories" => $categories,
            "css" => [
                "/assets/css/summernote-bs5.min.css",
                "/assets/css/select2/select2.min.css",
                "/assets/css/select2/select2-bootstrap-5-theme.min.css"
            ],
            "javascript" => [
                "/assets/js/summernote-bs5.min.js",
                "/assets/js/select2/select2.full.min.js",
                "/assets/js/dashboard/summernote-select2.js",
                "/assets/js/dashboard/preview-cover.js",
                "/assets/js/popovers.js"
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:publications,title',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:1024|dimensions:ratio=16/9',
            'content' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ], [
            'cover.dimensions' => "Image Ratio Must be 16/9, for example 1920x1080 (FHD) or 1280x720 (HD)",
            'cover.max' => "Max Cover size is 1MB"
        ]);

        $validated['user_id'] = auth()->id();
        $validated['coverWebp'] = $this->publicationService->storeCoverAsWebp($validated['cover']);

        $publication = $this->publicationService->createPublication($validated);
        return redirect("/dashboard/publications")->with("success", "New Publication has been added!");
    }

    public function edit(Publication $publication)
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Publications', 'url' => url('/dashboard/publications'), 'active' => false],
            ['label' => $publication->title, 'url' => '', 'active' => true]
        ];

        $contentHtml = file_get_contents($publication->content);
        $publication->with('user', 'categories')->get();
        return response()->view('dashboard.publications.edit', [
            "title" => "Publications",
            'breadcrumbs' => $breadcrumbs,
            "publication" => $publication,
            "categories" => Category::all(),
            "contentHtml" => $contentHtml,
            "css" => [
                "/assets/css/summernote-bs5.min.css",
                "/assets/css/select2/select2.min.css",
                "/assets/css/select2/select2-bootstrap-5-theme.min.css"
            ],
            "javascript" => [
                "/assets/js/summernote-bs5.min.js",
                "/assets/js/select2/select2.full.min.js",
                "/assets/js/dashboard/summernote-select2.js",
                "/assets/js/dashboard/preview-cover.js",
                "/assets/js/popovers.js"
            ]
        ]);
    }

    public function update(Request $request, Publication $publication)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:publications,title,' . $publication->id,
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:1024|dimensions:ratio=16/9',
            'content' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ], [
            'cover.dimensions' => "Image Ratio Must be 16/9, for example 1920x1080 (FHD) or 1280x720 (HD)",
            'cover.max' => "Max Cover size is 2MB"
        ]);

        $validated['user_id'] = auth()->id();

        if (isset($validated['cover'])) {
            $validated['coverWebp'] = $this->publicationService->storeCoverAsWebp($validated['cover']);
        }

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
