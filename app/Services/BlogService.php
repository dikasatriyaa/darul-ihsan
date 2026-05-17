<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BlogService
{
    public function getAll($perPage = 10)
    {
        return Blog::query()
            ->select('id', 'title', 'slug', 'image', 'user_id', 'views', 'created_at')
            ->with([
                'user:id,name,email'
            ]) // eager loading (hindari N+1)
            ->latest()
            ->paginate($perPage);
    }

    public function getRelatedBlogs(Blog $blog, $limit = 3)
    {
        return Blog::where('id', '!=', $blog->id)
            ->where('tag', 'like', '%' . $blog->first_tag . '%')
            ->latest()
            ->take($limit)
            ->get();
    }

    public function incrementViews(Blog $blog)
    {
        $blog->increment('views');
    }

    public function findBySlug($slug)
    {
        return Blog::query()
            ->with(['user:id,name,deskripsi,email,pekerjaan'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Blog::create([
                'image' => $data['image'] ?? null,
                'slug' => Str::slug($data['title']),
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'tag' => $data['tag'] ?? null,
                'body' => $data['body'],
            ]);
        });
    }

    public function update($id, array $data)
    {
        $blog = Blog::findOrFail($id);

        return DB::transaction(function () use ($blog, $data) {
            $blog->update($data);
            return $blog;
        });
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        return $blog->delete();
    }

    public function getLatestForHome($limit = 3)
    {
        return Blog::query()
            ->select('id', 'title', 'slug', 'image', 'user_id', 'created_at', 'body')
            ->with([
                'user:id,name'
            ]) // anti N+1
            ->latest()
            ->take($limit)
            ->get();
    }
}
