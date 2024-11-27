<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password',
    ];
    
    // Relasi dengan model Project
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
