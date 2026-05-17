<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Halaman daftar blog
     */
    public function index()
    {
        $blogs = $this->blogService->getAll(9);

        return view('blog.index', compact('blogs'));
    }

    /**
     * Halaman detail blog (pakai slug)
     */
    public function show($slug)
    {
        $blog = $this->blogService->findBySlug($slug);

        $this->blogService->incrementViews($blog);

        $relatedBlogs = $this->blogService->getRelatedBlogs($blog);

        return view('blog.show', compact('blog', 'relatedBlogs'));
    }

    /**
     * Simpan blog (biasanya untuk admin panel)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|string',
            'tag' => 'nullable|string'
        ]);

        $this->blogService->store($validated);

        return redirect()
            ->route('blog.index')
            ->with('success', 'Blog berhasil dibuat.');
    }

    /**
     * Update blog
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'image' => 'nullable|string',
            'tag' => 'nullable|string'
        ]);

        $this->blogService->update($id, $validated);

        return redirect()
            ->back()
            ->with('success', 'Blog berhasil diperbarui.');
    }

    /**
     * Hapus blog
     */
    public function destroy($id)
    {
        $this->blogService->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Blog berhasil dihapus.');
    }
}
