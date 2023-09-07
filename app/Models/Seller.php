<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard ='admins';

    protected $fillable = [
        'full_name',
        'username',
        'email',
        'email_verified_at',
        'photo',
        'password',
        'phone',
        'status',
        'address'
    ];
}
