<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;
class Order extends Model
{
  protected $fillable = [
    'user_id',
    'invoice_number',
    'recipient_name',
    'phone',
    'address',
    'shipping_method',
    'payment_method',
    'total',
    'payment_status',
    'status',
    'payment_proof',
    'snap_token',
    'midtrans_transaction_id',
    'midtrans_payment_type',
    'midtrans_transaction_status',
    'order_type',
    'cashier_id',
];

    public function items()
{
    return $this->hasMany(OrderItem::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
public function testimonial()
{
    return $this->hasOne(Testimonial::class);
}
public function cashier()
{
    return $this->belongsTo(User::class, 'cashier_id');
}
}