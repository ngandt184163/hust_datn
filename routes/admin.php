<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace' => 'Backend','prefix' => 'auth'], function () {
    Route::get('login', [Backend\AuthController::class, 'login'])->name('get_admin.login');
    Route::post('login', [Backend\AuthController::class, 'postLogin']);
});

Route::group(['namespace' => 'Backend','prefix' => 'admin','middleware' => 'check.login.admin'], function (){
    Route::get('',[Backend\HomeController::class,'index'])->name('get_admin.home');
    Route::get('logout',[Backend\AuthController::class,'logout'])->name('get_admin.logout');
    Route::group(['prefix' => 'category'], function (){
        Route::get('',[Backend\CategoryController::class,'index'])->name('get_admin.category.index')->middleware('permission:full|category_index');
        Route::get('create',[Backend\CategoryController::class,'create'])->name('get_admin.category.create')->middleware('permission:full|category_create');
        Route::post('create',[Backend\CategoryController::class,'store'])->name('get_admin.category.store')->middleware('permission:full|category_create');

        Route::get('update/{id}',[Backend\CategoryController::class,'edit'])->name('get_admin.category.update')->middleware('permission:full|category_update');
        Route::post('update/{id}',[Backend\CategoryController::class,'update'])->name('get_admin.category.update');
        Route::get('delete/{id}',[Backend\CategoryController::class,'delete'])->name('get_admin.category.delete')->middleware('permission:full|category_delete');
    });
    Route::group(['prefix' => 'menu'], function (){
        Route::get('',[Backend\MenuController::class,'index'])->name('get_admin.menu.index')->middleware('permission:full|menu_index');
        Route::get('create',[Backend\MenuController::class,'create'])->name('get_admin.menu.create')->middleware('permission:full|menu_create');
        Route::post('create',[Backend\MenuController::class,'store'])->name('get_admin.menu.store')->middleware('permission:full|menu_create');

        Route::get('update/{id}',[Backend\MenuController::class,'edit'])->name('get_admin.menu.update')->middleware('permission:full|menu_update');
        Route::post('update/{id}',[Backend\MenuController::class,'update'])->name('get_admin.menu.update');
        Route::get('delete/{id}',[Backend\MenuController::class,'delete'])->name('get_admin.menu.delete')->middleware('permission:full|menu_delete');
    });

    Route::group(['prefix' => 'article'], function (){
        Route::get('',[Backend\ArticleController::class,'index'])->name('get_admin.article.index')->middleware('permission:full|article_index');
        Route::get('create',[Backend\ArticleController::class,'create'])->name('get_admin.article.create')->middleware('permission:full|article_create');
        Route::post('create',[Backend\ArticleController::class,'store'])->name('get_admin.article.store')->middleware('permission:full|article_create');

        Route::get('update/{id}',[Backend\ArticleController::class,'edit'])->name('get_admin.article.update')->middleware('permission:full|article_update');
        Route::post('update/{id}',[Backend\ArticleController::class,'update'])->name('get_admin.article.update');
        Route::get('delete/{id}',[Backend\ArticleController::class,'delete'])->name('get_admin.article.delete')->middleware('permission:full|article_delete');
    });

    Route::group(['prefix' => 'article-blog'], function (){
        Route::get('',[Backend\ArticleBlogController::class,'index'])->name('get_admin.article_blog.index');
        Route::get('create',[Backend\ArticleBlogController::class,'create'])->name('get_admin.article_blog.create');
        Route::post('create',[Backend\ArticleBlogController::class,'store'])->name('get_admin.article_blog.store');

        Route::get('update/{id}',[Backend\ArticleBlogController::class,'edit'])->name('get_admin.article_blog.update');
        Route::post('update/{id}',[Backend\ArticleBlogController::class,'update'])->name('get_admin.article_blog.update');
        Route::get('delete/{id}',[Backend\ArticleBlogController::class,'delete'])->name('get_admin.article_blog.delete');
    });

    Route::group(['prefix' => 'pet'], function (){
        Route::get('',[Backend\PetController::class,'index'])->name('get_admin.pet.index')->middleware('permission:full|pet_index');
        Route::get('create',[Backend\PetController::class,'create'])->name('get_admin.pet.create')->middleware('permission:full|pet_create');
        Route::post('create',[Backend\PetController::class,'store'])->name('get_admin.pet.store')->middleware('permission:full|pet_create');

        Route::get('update/{id}',[Backend\PetController::class,'edit'])->name('get_admin.pet.update')->middleware('permission:full|pet_update');
        Route::post('update/{id}',[Backend\PetController::class,'update'])->name('get_admin.pet.update');
        Route::get('delete/{id}',[Backend\PetController::class,'delete'])->name('get_admin.pet.delete')->middleware('permission:full|pet_delete');
    });

    Route::group(['prefix' => 'user'], function (){
        Route::get('',[Backend\UserController::class,'index'])->name('get_admin.user.index')->middleware('permission:full|user_index');
        Route::get('create',[Backend\UserController::class,'create'])->name('get_admin.user.create')->middleware('permission:full|user_create');
        Route::post('create',[Backend\UserController::class,'store'])->name('get_admin.user.store')->middleware('permission:full|user_store');

        Route::get('update/{id}',[Backend\UserController::class,'edit'])->name('get_admin.user.update')->middleware('permission:full|user_update');
        Route::post('update/{id}',[Backend\UserController::class,'update'])->name('get_admin.user.update')->middleware('permission:full|user_update');
        Route::get('delete/{id}',[Backend\UserController::class,'delete'])->name('get_admin.user.delete')->middleware('permission:full|user_delete');
    });

    Route::group(['prefix' => 'profile'], function (){
        Route::get('',[Backend\ProfileController::class,'index'])->name('get_admin.profile.index');
        Route::post('update/{id}',[Backend\ProfileController::class,'updateProfile'])->name('post_admin.profile.update');
        Route::get('update-password',[Backend\ProfileController::class,'updatePassword'])->name('get_admin.profile.update_password');
        Route::post('update-password/{id}',[Backend\ProfileController::class,'processUpdatePassword'])->name('post_admin.profile.update_password');
    });
});

