<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = [
        'year',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
