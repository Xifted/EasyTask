<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    use HasFactory;

    protected $fillable = ['name_level'];

    public function users()
    {
        return $this->hasMany(User::class, 'level_id');
    }
}