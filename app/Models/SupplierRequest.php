<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierRequest extends Model
{
    use HasFactory;

    protected $table = 'supplier_requests';

    protected $fillable = [
        'name',
        'photo',
        'telephone',
        'email',
        'role',
        'date',
        'status',
    ];
}
