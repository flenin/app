<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Trip extends Model
{
    use HasFactory;

    protected $casts = [
        'adults' => 'integer',
        'children' => 'integer',
        'luggages' => 'integer',
        'from_date' => 'date:Y-m-d',
        'from_time' => 'datetime:H:i',
    ];

    protected $fillable = [
        'from_date',
        'from_time',
        'adults',
        'children',
        'luggages',
        'name',
        'phone',
        'paid',
        'status',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }
    
    protected function amountWithVoucher(): Attribute
    {
        return Attribute::make(function () {
            if ($this->voucher !== null) {
                return $this->amount - $this->voucher->amount;
            }

            return $this->amount;
        });
    }
}
