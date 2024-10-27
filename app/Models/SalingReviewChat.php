<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalingReviewChat extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'progress_id', 'user_id'];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
