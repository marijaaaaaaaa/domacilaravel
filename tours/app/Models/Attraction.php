<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
