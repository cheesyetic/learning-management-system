<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_date',
        'status',
        'type',
        'score',
        'note',
        'file',
        'user_id',
        'task_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
