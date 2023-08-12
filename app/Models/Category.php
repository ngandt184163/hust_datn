<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = [''];

    public function pets()
    {
        return $this->hasMany(Pet::class, 'category_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Sự kiện deleting để xóa liên kết với bảng Pets
        static::deleting(function ($category) {
            $category->pets()->delete();
        });
    }
}
