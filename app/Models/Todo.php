<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['task', 'description', 'completed', 'project_id'];

    // Relasi dengan project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
