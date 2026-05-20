<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'toy_code',
        'color_id',
        'year_id',
        'designer_id',
        'series_id',
        'notes',
        'extras',
        'isPacked',
        'img_url',
    ];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function designer()
    {
        return $this->belongsTo(Designer::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class);
    }

    protected static function booted()
    {
        static::deleting(function ($car) {
            $car->extras()->detach();
        });
    }
}
