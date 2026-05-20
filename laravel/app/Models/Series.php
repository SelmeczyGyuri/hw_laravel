<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = [
        'series',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
