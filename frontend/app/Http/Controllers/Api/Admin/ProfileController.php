<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'tagline' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string',
            'about_description' => 'sometimes|nullable|string',
            'photo' => 'sometimes|nullable|image|max:2048',
            'cv_url' => 'sometimes|nullable|string|max:255',
            'email' => 'required|email|max:255',
            'github' => 'sometimes|nullable|string|max:255',
            'linkedin' => 'sometimes|nullable|string|max:255',
        ]);

        $profile = Profile::first();

        if (!$profile) {
            $profile = Profile::create($validated);
            return response()->json($profile);
        }

        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $validated['photo'] = $request->file('photo')->store('profile', 'public');
        }

        $profile->update($validated);

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
