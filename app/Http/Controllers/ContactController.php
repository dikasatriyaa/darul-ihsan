<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $contact = $this->contactService->getLatest();

        return view('contact', compact('contact'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'message' => 'required|string',
            ],
            [
                'name.required' => 'Nama perlu diisi.',
                'email.required' => 'Email perlu diisi.',
                'email.email' => 'Format email tidak valid.',
                'message.required' => 'Pesan perlu diisi.',
            ]
        );

        $this->contactService->sendMessage($validated);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}
