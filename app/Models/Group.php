<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function invitedBy()
    {
        return $this->belongsToMany(User::class, 'invitations')->withTimestamps();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($group) {
            do {
                $group->code = Str::random(6);
            } while (Group::where('code', $group->code)->exists());
        });
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function groupmessages()
    {
        return $this->hasMany(Groupmessage::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
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
