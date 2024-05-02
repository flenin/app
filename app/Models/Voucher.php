<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $casts = [
        'amount' => 'integer',
    ];

    public $timestamps = false;

    protected $fillable = [
        'code',
        'amount',
    ];
}
