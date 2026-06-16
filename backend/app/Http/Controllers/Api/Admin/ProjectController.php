<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::ordered()->get();

        return response()->json($projects);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tech_stack' => 'nullable|array',
            'tech_stack.*' => 'string',
            'image' => 'nullable|image|max:2048',
            'demo_url' => 'nullable|string|max:255',
            'github_url' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'order_column' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        $project = Project::create($validated);

        return response()->json($project, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'tech_stack' => 'sometimes|nullable|array',
            'tech_stack.*' => 'string',
            'image' => 'sometimes|nullable|image|max:2048',
            'demo_url' => 'sometimes|nullable|string|max:255',
            'github_url' => 'sometimes|nullable|string|max:255',
            'is_featured' => 'boolean',
            'order_column' => 'sometimes|required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        if ($request->has('is_featured')) {
            $validated['is_featured'] = $request->boolean('is_featured');
        }

        $project->update($validated);

        return response()->json($project);
    }

    public function destroy(int $id): JsonResponse
    {
        $project = Project::findOrFail($id);

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }
}
