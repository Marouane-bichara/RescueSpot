<?php

namespace App\Models;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shelter extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'shelterName',
        'address',
        'city',
        'state',
        'zip_code', 
        'country',
        'description',
        'website',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }
    public function animals()
    {
        return $this->hasMany(Animal::class); // A shelter has many animals
    }
}
