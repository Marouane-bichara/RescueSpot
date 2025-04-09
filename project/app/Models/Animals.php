<?php

namespace App\Models;

use App\Models\Shelters;
use App\Models\Adoptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animals extends Model
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
        return $this->belongsTo(Shelters::class); // Foreign key is shelter_id in the animals table
    }


    public function adoptions()
    {
        return $this->hasMany(Adoptions::class, 'animalId');
    }
    
}
