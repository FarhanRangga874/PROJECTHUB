<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload</title>
</head>
<body>
    <form action="{{ route('pdf.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="pdf">Upload PDF:</label>
        <input type="file" name="pdf" accept="application/pdf">
        <button type="submit">Upload</button>
    </form>
    
</body>
</html>