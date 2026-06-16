<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessage;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $recipient = Profile::first()?->email ?? config('mail.from.address');

        Mail::to($recipient)->send(new ContactMessage(
            $validated['name'],
            $validated['email'],
            $validated['message'],
        ));

        return response()->json(['message' => 'Message sent successfully!']);
    }
}
