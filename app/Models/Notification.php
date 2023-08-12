<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    
    protected $table = 'notifications';
    protected $guarded = [''];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id_nguon', 'id');
    }
    
    public function recipient()
    {
        return $this->belongsTo(User::class, 'user_id_dich', 'id');
    }
    
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'id');
    }
}
