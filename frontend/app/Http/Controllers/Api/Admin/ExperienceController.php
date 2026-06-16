<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(): JsonResponse
    {
        $experiences = Experience::ordered()->get();

        return response()->json($experiences);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_or_institution' => 'required|string|max:255',
            'type' => 'required|in:work,education',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'order_column' => 'required|integer|min:0',
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $experience = Experience::create($validated);

        return response()->json($experience, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $experience = Experience::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'company_or_institution' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|in:work,education',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'sometimes|nullable|string',
            'order_column' => 'sometimes|required|integer|min:0',
        ]);

        if ($request->has('is_current')) {
            $validated['is_current'] = $request->boolean('is_current');
            if ($validated['is_current']) {
                $validated['end_date'] = null;
            }
        }

        $experience->update($validated);

        return response()->json($experience);
    }

    public function destroy(int $id): JsonResponse
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return response()->json(['message' => 'Experience deleted successfully']);
    }
}
