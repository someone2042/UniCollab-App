<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fileversion extends Model
{
    use HasFactory;

    public function parentfile()
    {
        return $this->belongsTo(File::class);
    }
}
