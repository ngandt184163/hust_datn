<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    use HasFactory;

    protected $table = 'user_follows';
    protected $guarded = [''];

    public function userFollow()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function followedUser()
    {
        return $this->belongsTo(User::class, 'user_follow_id');
    }

    // xóa không ảnh hưởng ai.
}
