<?php

namespace App\Models;

use App\Models\Shelter;
use App\Models\Adoption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'photoAnimal',
        'species',
        'breed',
        'age',
        'status',
        'shelter_id'
    ];

    public function shelters()
    {
        return $this->belongsTo(Shelter::class , 'shelter_id'); // Foreign key is shelter_id in the animals table
    }

 
    public function adoptions()
    {
        return $this->hasMany(Adoption::class, 'animalId');
    }
    
}
