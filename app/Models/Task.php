<?php

namespace App\Models;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $table = "tasks";

    protected $fillable = ['name', 'description', 'type', 'day', 'todo_id'];

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
