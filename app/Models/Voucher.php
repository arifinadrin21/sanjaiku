<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Voucher extends Model
{
    protected $fillable = [
        'code',
        'name',
        'type',
        'discount_amount',
        'minimum_purchase',
        'quota',
        'used',
        'start_date',
        'expired_date',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'start_date' => 'date',
        'expired_date' => 'date',
    ];

    public function redemptions()
    {
        return $this->hasMany(VoucherRedemption::class);
    }
}