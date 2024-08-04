<?php

namespace App\Models;

use App\Events\MessageSent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dosen_id',
        'message',
        'sender',
    ];

    protected $dispatchesEvents = [
        'created' => MessageSent::class,
    ];
}
