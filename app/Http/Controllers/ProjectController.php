<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $this->validateProject($request);

        Project::create([
            'name' => $request->name
        ]);

        return redirect()->route('projects.index');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id); 
        return view('projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id); 
        return view('edit', compact('project')); 
    }

    public function update(Request $request, $id)
    {
        $this->validateProject($request);

        $project = Project::findOrFail($id); 
        $project->update([
            'name' => $request->name
        ]);

        return redirect('/workplace')->with('success', 'Proyek berhasil di update.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id); 
        $project->delete();

        return redirect('/workplace')->with('success', 'Proyek berhasil dihapus.');
    }

    private function validateProject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
    }
}

