<?php

namespace App\Models;

use App\Models\Report;
use App\Models\Message;
use App\Models\Shelter;
use App\Models\Adoption;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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
        'profilePhoto',
        'password',
        'status',
        'role_id',
        'birthday',
        'backgroundProfile',
        'phone',
        'address',
        'city',
        'country',
        'bio',
        'relationship_status',
        'instagram',
        'twitter',
        'linkedin',
        'facebook',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function shelter()
    {
        return $this->hasOne(Shelter::class); 
    }


    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }


    public function adoptions()
    {
        return $this->hasMany(Adoption::class, 'adopterId');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id');
    }

    public function followedUsers()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id');
    }
}
