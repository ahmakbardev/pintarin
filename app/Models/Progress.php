<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'modul_id',
        'materi_ids',
    ];

    protected $casts = [
        'materi_ids' => 'array',
    ];
}
