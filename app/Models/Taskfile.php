<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taskfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'size',
        'path',
        'task_id',
    ];

    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }
}
