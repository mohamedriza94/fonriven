<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;
    
    protected $table = 'connections';
    
    protected $fillable = [
        'no',
        'buyer',
        'supplier',
        'date',
        'status',
    ];
}
