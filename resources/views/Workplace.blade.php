<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Workplace</title>
    <link rel="stylesheet" href="/css/Workplace.css">
</head>
<body>
    <div class="Sidebar">
        <img src="\src\TEAMSYCN__3_-removebg-preview.png" alt="">
        <div class="user-name">
            <p><img src="\src\icons8-user-96 (1).png" alt=""> {{ $user->username }}</p>
        </div>

        <div class="project">
            <h2>PROJECTS </h2>
            <div class="daftar">
                @if($projects->isEmpty())
                    <p>No projects available</p>
                @else
                    @foreach($projects as $project)
                    <!-- Add project -->
                        <div class="project-item">
                            <a href="{{ route('project.files', $project->id) }}" 
                               class="{{ isset($currentProject) && $currentProject->id === $project->id ? 'active' : '' }}">
                               {{ $project->name }}
                            </a>
                            <div class="project-options">
                                <!-- Edit Project -->
                                <form action="{{ route('project.edit', $project->id) }}" method="GET" style="display:inline;">
                                    <button type="submit" class="edit-btn">Edit</button>
                                </form>
    
                                <!-- Delete Project -->
                                <form action="{{ route('project.destroy', $project->id) }}" method="POST" style="display:inline;" 
                                      onsubmit="return confirm('Are you sure you want to delete this project?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="add-project">
                <form action="{{ route('project.create') }}" method="POST">
                    @csrf
                    <input type="text" name="project_name" placeholder="New Project Name" required>
                    <button type="submit">Add Project</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="Workplace">
        <div class="greating">
            <h2>PROJECT {{ isset($currentProject) ? $currentProject->name : 'No Project Selected' }}</h2>
        </div>

        <div class="File">
            <div class="header_file">
                <img src="/src/icons8-file-48.png" alt="File Icon">
                <div class="keterangan">
                    <h2>FILE</h2>
                    <p>Manage your project files here</p>
                </div>
            </div>
            <div class="Daftar_file">
                @if(!isset($files) || $files->isEmpty())
                    <p>No files uploaded for this project</p>
                @else
                    @foreach($files as $file)
                        <div class="file-item">
                            <div class="item">
                                <img src="/src/icons8-pdf-50.png" alt="PDF Icon">
                                <div class="keterangan">
                                    <p>{{ $file->filename }}</p>
                                    <p>{{ $file->created_at }}</p>
                                </div>
                            </div>
                            <div class="file_setting">
                                <form action="{{ route('workplace.rename', $file->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="new_filename" value="{{ $file->filename }}" required>
                                    <button type="submit" class="set_rename">Rename</button>
                                </form>
                                <form action="{{ route('workplace.delete', $file->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="set_del"><img src="/src/icons8-trash-can-96.png" alt="Delete Icon"></button>
                                </form>
                                <a href="{{ route('workplace.download', $file->id) }}" class="button_file"><img src="/src/icons8-export-pdf-96.png" alt="Download Icon"></a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        @if(isset($currentProject))
            <div class="addfile">
                <form action="{{ route('project.upload', $currentProject->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="pdf" accept="application/pdf" required>
                    <button type="submit">Upload File</button>
                </form>
            </div>
        @endif
    </div>
    <div class="todo">
            <!-- To-Do List Section -->
            @if(isset($currentProject))
            <div class="Todo-list">
                <div class="header_todo">
                    <img src="\src\icons8-to-do-list-96.png" alt="">
                    <h2>To-Do List</h2>
                </div>
                
    
                <!-- Add To-Do -->
                <form action="{{ route('workplace.todos.store', $currentProject->id) }}" method="POST">
                    @csrf
                    <input type="text" name="task" placeholder="New To-Do" required>
                    <button type="submit">Add</button>
                </form>
    
                <!-- Display To-Do List -->
                <ul>
                    @foreach($currentProject->todos as $todo)
                        <li>
                            <form action="{{ route('workplace.todos.update', [$currentProject->id, $todo->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="checkbox" name="completed" {{ $todo->completed ? 'checked' : '' }} onclick="this.form.submit()">
                                <span>{{ $todo->task }}</span>
                            </form>
    
                            <!-- Delete To-Do -->
                            <form action="{{ route('workplace.todos.destroy', [$currentProject->id, $todo->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>

</body>
</html>
