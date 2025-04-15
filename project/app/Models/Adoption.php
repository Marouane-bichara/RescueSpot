<?php

namespace App\Models;

use App\Models\User;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'requestDate',
        'animalId',
        'adopterId',
        'status',
    ];


    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animalId');
    }


    public function adopter()
    {
        return $this->belongsTo(User::class, 'adopterId');
    }
}
