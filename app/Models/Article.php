<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $guarded = [''];

    // protected $fillable = [
    //     'name',
    // ];

    public function articleActions()
    {
        return $this->hasMany(ArticleAction::class, 'article_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'article_id', 'id');
    }


    // Xử lý sự kiện deleting
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($article) {
            $article->articleActions()->delete();
            $article->comments()->delete();
            $article->notifications()->delete();
            // Các phụ thuộc khác
        });
    }
}