<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('attributes');

        if ($request->has('filters')) {
            foreach ($request->filters as $key => $value) {
                if ($key === 'name' || $key === 'status') {
                    $query->where($key, 'LIKE', "%$value%");
                } else {
                    $query->whereHas('attributes', function ($q) use ($key, $value) {
                        $q->whereHas('attribute', function ($attrQuery) use ($key) {
                            $attrQuery->where('name', $key);
                        })->where('value', $value);
                    });
                }
            }
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'attributes' => 'nullable|array',
        ]);

        $project = Project::create($validated);

        if (isset($request->attributes)) {
            foreach ($request->attributes as $attribute_id => $value) {
                AttributeValue::create([
                    'attribute_id' => $attribute_id,
                    'entity_id' => $project->id,
                    'value' => $value,
                ]);
            }
        }

        return response()->json($project, 201);
    }

    public function show($id)
    {
        return response()->json(Project::with('attributes')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'name' => 'string',
            'status' => 'string',
            'attributes' => 'nullable|array',
        ]);

        $project->update($validated);

        if (isset($request->attributes)) {
            foreach ($request->attributes as $attribute_id => $value) {
                AttributeValue::updateOrCreate(
                    ['attribute_id' => $attribute_id, 'entity_id' => $project->id],
                    ['value' => $value]
                );
            }
        }

        return response()->json($project);
    }

    public function destroy($id)
    {
        Project::findOrFail($id)->delete();
        return response()->json(['message' => 'Project deleted']);
    }
}
