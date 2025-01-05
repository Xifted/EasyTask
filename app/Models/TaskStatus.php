<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;
    protected $table = "task_status";
    protected $fillable = ['name'];

    public function details()
    {
        return $this->hasMany(TaskDetail::class, 'status_id');
    }
}
