<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    protected $fillable = [
        'designer',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
