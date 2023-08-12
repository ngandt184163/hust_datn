<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pets';
    protected $guarded = [''];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'pet_id');
    }

    public function petActions()
    {
        return $this->hasMany(PetAction::class, 'pet_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'pet_id', 'id');
    }

    // Xử lý sự kiện deleting
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($pet) {
            $pet->articles()->delete();
            $pet->petActions()->delete();
            $pet->notifications()->delete();
            // Các phụ thuộc khác
        });
    }
}
