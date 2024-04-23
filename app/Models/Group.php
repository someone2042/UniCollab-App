<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'type',
        'leader_id',
        'description',
    ];

    // public function members()
    // {
    //     return $this->belongsToMany(User::class);
    // }
    // public function leader()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members() // Custom name for the relationship
    {
        return $this->belongsToMany(User::class, 'group_memberships') // Specify custom table
            ->withTimestamps();
    }

    // public function members() // Custom name for the relationship
    // {
    //     return $this->belongsToMany(User::class, 'group_memberships') // Specify custom table
    //         ->withTimestamps()
    //         ->withPivot('joined_at');
    // }

    // public function invitations()
    // {
    //     return $this->hasMany(Invitation::class);
    // }
}
