<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'quantity',
        'condition',
        'purchase_date',
        'description',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'quantity' => 'integer',
    ];
}
