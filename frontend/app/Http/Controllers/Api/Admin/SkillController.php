<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(): JsonResponse
    {
        $skills = Skill::ordered()->get();

        return response()->json($skills);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|url|max:2048',
            'level' => 'required|integer|min:0|max:100',
            'category' => 'required|string|max:255',
            'order_column' => 'required|integer|min:0',
        ]);

        $skill = Skill::create($validated);
        return response()->json($skill, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $skill = Skill::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'icon' => 'sometimes|nullable|url|max:2048',
            'level' => 'sometimes|required|integer|min:0|max:100',
            'category' => 'sometimes|required|string|max:255',
            'order_column' => 'sometimes|required|integer|min:0',
        ]);

        $skill->update($validated);
        return response()->json($skill);
    }

    public function destroy(int $id): JsonResponse
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return response()->json(['message' => 'Skill deleted successfully']);
    }
}
