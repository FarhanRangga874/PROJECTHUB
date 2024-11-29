<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Project;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
        $todos = $project->todos; 
        return view('workplace', compact('project', 'todos')); 
    }

    public function store(Request $request, $projectId)
    {
        $request->validate([
            'task' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::findOrFail($projectId);

        Todo::create([
            'task' => $request->task,
            'description' => $request->description,
            'project_id' => $project->id,
        ]);

        return redirect()->route('workplace', $project->id) // Ganti ke workplace
                         ->with('success', 'To-Do berhasil ditambahkan.');
    }

    public function update(Request $request, $projectId, $todoId)
    {
        $todo = Todo::findOrFail($todoId);
        $todo->update([
            'completed' => $request->has('completed') ? true : false,
        ]);

        return redirect()->route('workplace', $projectId)
                         ->with('success', 'Status To-Do berhasil diperbarui.');
    }

    public function destroy($projectId, $todoId)
    {
        $todo = Todo::findOrFail($todoId);
        $todo->delete();

        return redirect()->route('workplace', $projectId) 
                         ->with('success', 'To-Do berhasil dihapus.');
    }
}

