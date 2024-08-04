<?php

namespace App\Models;

use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'task_id', 'description', 'pdf_path', 'ppt_path', 'nilai'
    ];

    protected $casts = [
        'nilai' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
