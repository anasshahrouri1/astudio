<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        return response()->json(Attribute::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'type' => 'required|string|in:text,date,number,select',
        ]);

        $attribute = Attribute::create($validated);
        return response()->json($attribute, 201);
    }

    public function show($id)
    {
        return response()->json(Attribute::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);

        $validated = $request->validate([
            'name' => 'string',
            'type' => 'string|in:text,date,number,select',
        ]);

        $attribute->update($validated);
        return response()->json($attribute);
    }

    public function destroy($id)
    {
        Attribute::findOrFail($id)->delete();
        return response()->json(['message' => 'Attribute deleted']);
    }
}
