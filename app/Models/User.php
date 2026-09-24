<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang boleh diisi.
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
];

    /**
     * Atribut yang disembunyikan.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast atribut.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke keranjang.
     */
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * Relasi ke pesanan.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function testimonials()
{
    return $this->hasMany(Testimonial::class);
}
}