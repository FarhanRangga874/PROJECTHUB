<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Files; 
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class WorkplaceController extends Controller
{
    public function viewWorkplace()
    {
        $user = Auth::user(); 
        $projects = Project::all();
        return view('workplace', compact('user', 'projects')); 
    }
    
    public function viewProjectFiles($projectId)
    {
        $user = Auth::user();
        $projects = Project::all(); 
        $currentProject = Project::findOrFail($projectId); 
        $files = Files::where('project_id', $projectId)->get(); 
    
        return view('workplace', compact('user', 'projects', 'currentProject', 'files'));
    }

    public function uploadFileToProject(Request $request, $projectId)
    {
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('pdf');
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename, 'public'); 

        Files::create([
            'filename' => $filename,
            'filepath' => $path,
            'project_id' => $projectId,
        ]);

        return redirect()->route('project.files', $projectId);

    }

    public function downloadFile($id)
    {
        $file = Files::findOrFail($id);
    
        if (!Storage::disk('public')->exists($file->filepath)) {
            abort(404, 'File tidak ditemukan.');
        }
    
        return Storage::disk('public')->download($file->filepath); 
    }

    public function deleteFile($id)
    {
        $file = Files::findOrFail($id);

        if (Storage::disk('public')->exists($file->filepath)) {
            Storage::disk('public')->delete($file->filepath);
        }

        $file->delete();

        return redirect()->back()->with('success', 'File berhasil dihapus.');
    }

    public function renameFile(Request $request, $id)
    {
        $request->validate([
            'new_filename' => 'required|string|max:255',
        ]);
    
        $file = Files::findOrFail($id);
        $newFilename = $request->input('new_filename');
    
        if (pathinfo($newFilename, PATHINFO_EXTENSION) !== 'pdf') {
            $newFilename .= '.pdf';
        }
    
        $oldPath = $file->filepath;
        $newPath = 'uploads/' . $newFilename;
    
        if (Storage::disk('public')->exists($oldPath)) {
            if (Storage::disk('public')->move($oldPath, $newPath)) {
                $file->filename = $newFilename;
                $file->filepath = $newPath;
                $file->save();
    
                return redirect()->back()->with('success', 'Nama file berhasil diubah.');
            } else {
                return redirect()->back()->with('error', 'Gagal mengubah nama file.');
            }
        }
    
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
        public function createProject(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
        ]);

        Project::create([
            'name' => $request->input('project_name'),
        ]);

        return redirect()->route('workplace')->with('success', 'Project created successfully!');
    }

    public function edit($id)
{
    $project = Project::findOrFail($id);
    
    return view('projects.edit', compact('project'));
    }    
}
