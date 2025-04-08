<?php

namespace App\Models;

use App\Models\Animals;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shelters extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'location',
        'phone',
        'email',
        'website',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }
    public function animals()
    {
        return $this->hasMany(Animals::class); // A shelter has many animals
    }
}
