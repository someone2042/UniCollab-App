<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function versions()
    {
        return $this->hasMany(FileVersion::class);
    }

    public function currentVersion()
    {
        return $this->versions()->orderBy('version', 'desc')->first();
    }
}
