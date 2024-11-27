<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WorkplaceController;
use App\Http\Controllers\TodoController;

/* HOME */
Route::get('/', function () {
    return view('index');
});

/* REGISTER */
Route::get('/register', [UsersController::class, 'create'])->name('register.create');
Route::post('/register', [UsersController::class, 'store'])->name('register.store');

/* LOGIN */
Route::get('/login', [UsersController::class, 'viewlogin'])->name('login.view');
Route::post('/login', [UsersController::class, 'login'])->name('login');

/* LOGOUT */
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

/*FILE*/
Route::get('/workplace', [WorkplaceController::class, 'viewWorkplace'])->name('workplace');
Route::get('/project/{id}', [WorkplaceController::class, 'viewProjectFiles'])->name('project.files');
Route::post('/project/{id}/upload', [WorkplaceController::class, 'uploadFileToProject'])->name('project.upload');
Route::delete('/file/{id}', [WorkplaceController::class, 'deleteFile'])->name('workplace.delete');
Route::put('/file/{id}', [WorkplaceController::class, 'renameFile'])->name('workplace.rename');
Route::get('/file/{id}/download', [WorkplaceController::class, 'downloadFile'])->name('workplace.download');

// Group route for projects to enforce authentication
Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class);

    // Additional project management routes with 'auth' middleware
    Route::post('/project/create', [WorkplaceController::class, 'createProject'])->name('project.create');
    Route::get('project/{projectId}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('project/{projectId}', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('project/{projectId}', [ProjectController::class, 'destroy'])->name('project.destroy');
});

Route::get('project/{projectId}/edit', [ProjectController::class, 'edit'])->name('project.edit');
Route::delete('project/{projectId}', [ProjectController::class, 'destroy'])->name('project.destroy');
Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class);
});

Route::resource('projects', ProjectController::class);

// Halaman untuk melihat daftar To-Do pada proyek tertentu
Route::get('/workplace/{projectId}/todos', [TodoController::class, 'index'])->name('workplace.todos.index');

// Menambahkan To-Do pada proyek tertentu
Route::post('/workplace/{projectId}/todos', [TodoController::class, 'store'])->name('workplace.todos.store');

// Mengupdate status To-Do (selesai / belum)
Route::put('/workplace/{projectId}/todos/{todoId}', [TodoController::class, 'update'])->name('workplace.todos.update');

// Menghapus To-Do
Route::delete('/workplace/{projectId}/todos/{todoId}', [TodoController::class, 'destroy'])->name('workplace.todos.destroy');

