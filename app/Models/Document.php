<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'group_id',
        'user_id',
        'type',
        'size',
        'image',
        'file',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($module) {
    //         // dd($module->file);
    //         // Storage::delete($module->file);
    //         unlink($module->file);
    //     });
    // }
}
