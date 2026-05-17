<?php

namespace App\Http\Controllers;

use App\Services\AboutService;

class AboutController extends Controller
{
    protected $aboutService;

    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }

    public function index()
    {
        $about = $this->aboutService->getLatest();

        return view('about', compact('about'));
    }
}
