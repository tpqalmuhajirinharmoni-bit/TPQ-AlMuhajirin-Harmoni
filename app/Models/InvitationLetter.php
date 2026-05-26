<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'recipient_name',
        'subject',
        'event_date',
        'body',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];
}
