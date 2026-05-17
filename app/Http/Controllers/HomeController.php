<?php

namespace App\Http\Controllers;

use App\Services\BlogService;
use App\Models\About;
use App\Models\Contact;

class HomeController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index()
    {
        // Ambil 3 blog terbaru (sudah eager loading user)
        $blogs = $this->blogService->getLatestForHome(3);

        // About (1 data aktif)
        $about = About::query()
            ->select('id', 'title', 'image', 'body')
            ->latest()
            ->first();

        // Contact (1 data aktif)
        $contact = Contact::query()
            ->select('id', 'title', 'image', 'body')
            ->latest()
            ->first();

        return view('home', compact(
            'blogs',
            'about',
            'contact'
        ));
    }
}
