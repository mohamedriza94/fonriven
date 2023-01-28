<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    
    protected $table = 'ratings';
    
    protected $fillable = [
        'supplier_id',
        'buyer_id',
        'rating',
        'average',
    ];
}