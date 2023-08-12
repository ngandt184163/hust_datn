<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $guarded = [''];

    public function articles()
    {
        return $this->hasMany(Article::class, 'menu_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Sự kiện deleting để xóa liên kết với bảng Articles
        static::deleting(function ($menu) {
            $menu->articles()->delete();
        });
    }
}
