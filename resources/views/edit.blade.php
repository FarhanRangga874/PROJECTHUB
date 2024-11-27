<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Project</title>
    <link rel="stylesheet" href="/css/edit.css">
</head>
<body>
    <div class="container">
        <h1>EDIT PROJECT</h1>
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">PROJECT NAME</label>
                <input type="text" name="name" id="name" 
                    value="{{ old('name', $project->name) }}" required 
                    placeholder="Enter your project name">
            </div>
            <button type="submit" class="submit-btn">Update Project</button>
        </form>
    </div>
</body>
</html>
