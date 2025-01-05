<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskDetail extends Model
{
    protected $fillable = [
        'task_id',
        'title',
        'status_id',
        'deadline',
        'description',
    ];
    
    public function details()
    {
        return $this->hasMany(TaskDetail::class, 'task_id');
    }
}
