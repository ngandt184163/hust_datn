<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category;
        $category->name = 'Chó';
        $category->description = 'Chó';
        $category->slug = 'cho';
        $category->status = 1;
        $category->save();

        $category = new Category;
        $category->name = 'Mèo';
        $category->description = 'Mèo';
        $category->slug = 'meo';
        $category->status = 1;
        $category->save();

        $category = new Category;
        $category->name = 'Lợn';
        $category->description = 'Lợn';
        $category->slug = 'lon';
        $category->status = 1;
        $category->save();

        $category = new Category;
        $category->name = 'Gà';
        $category->description = 'Gà';
        $category->slug = 'ga';
        $category->status = 1;
        $category->save();
    }
}
