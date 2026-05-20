<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'extra',
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class);
    }
}
