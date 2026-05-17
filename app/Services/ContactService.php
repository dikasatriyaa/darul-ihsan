<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Message;

class ContactService
{
    public function getLatest()
    {
        return Contact::query()
            ->select('id', 'title', 'image', 'body')
            ->latest()
            ->first();
    }

    public function sendMessage(array $data)
    {
        return Message::create($data);
    }

    public function store(array $data)
    {
        return Contact::create($data);
    }
}
