<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupmessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'group_id',
        'user_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
