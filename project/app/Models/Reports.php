<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reports extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_id',
        'photo',
        'location',
        'reportDate',
        'description',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
