<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory;

    protected $table = 'clients';
    
    protected $fillable = [
        'name',
        'photo',
        'telephone',
        'email',
        'role',
        'joined',
        'status',
        'average',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $guard = 'client';
}
