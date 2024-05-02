<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;

class Location extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'from_address',
        'from_place_id',
        'to_address',
        'to_place_id',
        'distance',
        'duration',
    ];
}
