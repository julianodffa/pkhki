<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Support\Str;

class AuthorService
{
    protected $publicationService;

    public function __construct(PublicationService $publicationService)
    {
        $this->publicationService = $publicationService;
    }

    public function createAuthor(string $name): Author
    {
        $slug = $this->publicationService->createSlug($name);

        return Author::create([
            'name' => $name,
            'slug' => $slug,
        ]);
    }

    public function updateAuthor(Author $author, string $newName): bool
    {
        $slug = $this->publicationService->createSlug($newName);

        return $author->update([
            'name' => $newName,
            'slug' => $slug,
        ]);
    }

    public function canDeleteAuthor(Author $author): bool
    {
        return !$author->publications()->exists();
    }

    public function deleteAuthor(Author $author): void
    {
        $author->delete();
    }
}
