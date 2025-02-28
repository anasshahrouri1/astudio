<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        return response()->json(Timesheet::with(['user', 'project'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string',
            'date' => 'required|date',
            'hours' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        $timesheet = Timesheet::create($validated);
        return response()->json($timesheet, 201);
    }

    public function show($id)
    {
        return response()->json(Timesheet::with(['user', 'project'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $timesheet = Timesheet::findOrFail($id);

        $validated = $request->validate([
            'task_name' => 'string',
            'date' => 'date',
            'hours' => 'integer',
        ]);

        $timesheet->update($validated);
        return response()->json($timesheet);
    }

    public function destroy($id)
    {
        Timesheet::findOrFail($id)->delete();
        return response()->json(['message' => 'Timesheet record deleted']);
    }
}
