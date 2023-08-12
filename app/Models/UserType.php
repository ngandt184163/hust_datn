<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    protected $table = 'user_types';

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_has_types', 'user_type_id', 'user_id');
    }
}
