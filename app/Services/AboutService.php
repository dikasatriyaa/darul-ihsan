<?php

namespace App\Services;

use App\Models\About;

class AboutService
{
    public function getLatest()
    {
        return About::query()
            ->select('id', 'title', 'image', 'body')
            ->latest()
            ->first();
    }
}
