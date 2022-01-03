<?php

namespace App\Models;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $table = "tasks";

    protected $fillable = ['name', 'description', 'todo_id'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
