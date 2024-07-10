<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fileversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'version',
        'size',
        'path',
        'file_id',
    ];

    public function parentfile()
    {
        return $this->belongsTo(File::class);
    }
    //     protected static function boot()
    //     {
    //         parent::boot();

    //         static::deleting(function ($module) {
    //             dd($module);
    //             Storage::disk('public')->delete($module->path);
    //         });
    //     }
}
