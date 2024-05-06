<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_url',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // public function groups()
    // {
    //     return $this->belongsToMany(Group::class);
    // }
    // public function memberships() // Custom name for the relationship
    // {
    //     return $this->belongsToMany(Group::class, 'group_memberships') // Specify custom table
    //         ->withTimestamps()
    //         ->withPivot('joined_at');
    // }
    public function invitedGroups()
    {
        return $this->belongsToMany(Group::class, 'invitations')->withTimestamps();
    }

    public function leadingGroups()
    {
        return $this->hasMany(Group::class, 'leader_id');
    }

    public function memberships() // Custom name for the relationship
    {
        return $this->belongsToMany(Group::class, 'group_memberships') // Specify custom table
            ->withTimestamps();
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
