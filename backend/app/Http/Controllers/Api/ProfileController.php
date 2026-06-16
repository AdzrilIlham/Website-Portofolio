<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function index(): JsonResponse
    {
        $profile = Profile::first();

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        return response()->json([
            'id' => $profile->id,
            'name' => $profile->name,
            'tagline' => $profile->tagline,
            'description' => $profile->description,
            'about_description' => $profile->about_description,
            'photo' => $profile->photo ? url('storage/' . $profile->photo) : null,
            'cv_url' => $profile->cv_url,
            'email' => $profile->email,
            'github' => $profile->github,
            'linkedin' => $profile->linkedin,
            'created_at' => $profile->created_at,
            'updated_at' => $profile->updated_at,
        ]);
    }
}
