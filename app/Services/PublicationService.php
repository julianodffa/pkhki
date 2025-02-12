<?php

namespace App\Services;

use App\Models\Publication;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PublicationService
{
    public function createPublication($data)
    {
        // Pengunggahan file dan penyimpanan konten
        $coverReal = $this->uploadCover($data['cover']);
        $coverWebp = $data['coverWebp'];
        $contentPath = $this->saveContentAsHtml($data['content']);
        $slug = $this->createSlug($data['title']);

        $publication = Publication::create([
            'title' => $data['title'],
            'cover' => $coverReal,
            'cover_webp' => $coverWebp,
            'content' => $contentPath,
            'slug' => $slug,
            'user_id' => $data['user_id'],
            'excerpt' => Str::limit(strip_tags($data['content']), 200, '...')
        ]);

        $publication->categories()->attach($data['categories']);
        return $publication;
    }

    public function updatePublication(Publication $publication, $data)
    {
        $validatedData = $data;
        // Jika Titlenya Berubah
        if ($data['title'] !== $publication->title) {
            $validatedData['slug'] = $this->createSlug($data['title']);
        }

        if (isset($data['cover'])) {
            $this->deleteOldCover($publication);
            $validatedData['cover'] = $this->uploadCover($data['cover']);
            $validatedData['cover_webp'] = $data['coverWebp'];
        }

        if ($data['content'] !== file_get_contents(public_path($publication->content))) {
            $this->deleteOldContent($publication);
            $validatedData['content'] = $this->saveContentAsHtml($data['content']);
        } else {
            $validatedData['content'] = $publication->content;
        }

        $validatedData['excerpt'] = Str::limit(strip_tags($data['content']), 200, '...');
        $publication->update($validatedData);
        $publication->categories()->sync($data['categories']);
        return $publication;
    }

    public function deletePublication(Publication $publication)
    {
        $this->deleteOldCover($publication);
        $this->deleteOldContent($publication);
        $publication->categories()->detach();
        $publication->delete();
    }

    // Helper functions untuk file handling
    private function uploadCover($cover)
    {
        $coverName = Str::random(16) . '.' . $cover->getClientOriginalExtension();
        $cover->move(public_path('assets/publications/covers'), $coverName);
        return 'assets/publications/covers/' . $coverName;
    }

    public function storeCoverAsWebp(UploadedFile $file)
    {
        $coverName = Str::random(16);
        $image = Image::make($file)->encode('webp', 90); // Quality 90%
        $image->save(public_path('assets/publications/covers') . "/$coverName" . ".webp");
        return 'assets/publications/covers/' . $coverName . ".webp";
    }

    private function deleteOldCover(Publication $publication)
    {
        $coverPath = public_path($publication->cover);
        if (File::exists($coverPath)) {
            File::delete($coverPath);
        }

        $coverWebp = public_path($publication->cover_webp);
        if (File::exists($coverWebp)) {
            File::delete($coverWebp);
        }
    }

    private function saveContentAsHtml($content)
    {
        $fileName = Str::random(16) . '.html';
        $filePath = public_path('assets/publications/' . $fileName);
        file_put_contents($filePath, $content);
        return 'assets/publications/' . $fileName;
    }

    private function deleteOldContent(Publication $publication)
    {
        $contentPath = public_path($publication->content);
        if (File::exists($contentPath)) {
            File::delete($contentPath);
        }
    }

    // Function untuk membuat Slug
    public function createSlug($title): string
    {
        return strtolower(str_replace(' ', '-', preg_replace("/[^a-zA-Z0-9 ]/", '', str_replace("'", '', $title))));
    }
}
