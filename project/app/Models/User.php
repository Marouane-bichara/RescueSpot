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


  

    public function adoptions()
    {
        return $this->hasMany(Adoption::class, 'adopterId');
    }

 

 

    public function hasPermission($permission)
    {
        return $this->role && $this->role->permissions()->where('name', $permission)->exists();
    }
    
}
