<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory;

    protected $table = "todo";

    protected $fillable = ['name', 'description'];

    public function tasks()
    {
        return $this->hasMany(Task::class); 
        // 'todo_id', 'id' 
    }
}
