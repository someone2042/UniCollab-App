<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function members()
    {
        return $this->belongsToMany(User::class);
    }
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    // public function invitations()
    // {
    //     return $this->hasMany(Invitation::class);
    // }
}
