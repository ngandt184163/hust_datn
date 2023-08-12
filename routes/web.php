<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\User;
use App\Http\Requests\RegisterUserRequest;

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

//'middleware' => 'check.login.user'
Route::group(['namespace' => 'Frontend'], function (){
    Route::get('',[Frontend\HomeController::class,'index'])->name('get.home');
    Route::get('map',[Frontend\HomeController::class,'map'])->name('get.map');
    Route::get('blog',[Frontend\HomeController::class,'blog'])->name('get.blog');
    Route::get('blog/chia-se-kinh-nghiem',[Frontend\HomeController::class,'blogCSKN'])->name('get.blog.chia_se_kinh_nghiem');
    Route::get('blog/hoi-dap',[Frontend\HomeController::class,'blogHD'])->name('get.blog.hoi_dap');
    Route::get('blog/cho-nhan',[Frontend\HomeController::class,'blogCN'])->name('get.blog.cho_nhan');

    // Route::get('video',[Frontend\HomeController::class,'video'])->name('get.video');
    Route::get('video',[Frontend\HomeController::class,'video_2'])->name('get.video');
    Route::get('kham-pha',[Frontend\HomeController::class,'index'])->name('get.kham_pha');
    Route::get('video/{id}',[Frontend\HomeController::class,'video'])->name('get.video.detail');
    Route::get('blog/{id}',[Frontend\HomeController::class,'blogDetail'])->name('get.blog.detail');
    Route::get('search',[Frontend\HomeController::class,'search'])->name('get.search');
    Route::get('story/{id}',[Frontend\HomeController::class,'showStoryDetail'])->name('get.story.detail');

    Route::get('story/like/{id}',[Frontend\HomeController::class,'likeStory'])->name('get.story.detail.like');
    Route::get('story/dislike/{id}',[Frontend\HomeController::class,'dislikeStory'])->name('get.story.detail.dislike');

    Route::get('pet/{id}',[Frontend\HomeController::class,'showPetDetail'])->name('get.pet.detail');
    Route::get('pet/like/{id}',[Frontend\HomeController::class,'likePet'])->name('get.pet.detail.like')->middleware('check.login.user');
    Route::get('pet/dislike/{id}',[Frontend\HomeController::class,'dislikePet'])->name('get.pet.detail.dislike');

    Route::get('article/{id}',[Frontend\HomeController::class,'showArticleDetail'])->name('get.article.detail');
    Route::post('article/{id}',[Frontend\HomeController::class,'commentArticle'])->middleware('check.login.user');

    Route::get('article/like/{id}',[Frontend\HomeController::class,'likeArticle'])->name('get.article.detail.like')->middleware('check.login.user');
    Route::get('article/dislike/{id}',[Frontend\HomeController::class,'dislikeArticle'])->name('get.article.detail.dislike');

    Route::post('blog/{id}',[Frontend\HomeController::class,'commentArticle'])->name('get.article_blog.comment');

    Route::get('profile/{id}',[Frontend\HomeController::class,'profile'])->name('get.profile.detail')->middleware('check.login.user');
});

Route::group(['namespace' => 'Frontend'], function (){

    Route::get('dang-nhap',[Frontend\AuthController::class,'login'])->name('get.login');
    Route::post('dang-nhap',[Frontend\AuthController::class,'postLogin']);
    Route::get('dang-xuat',[Frontend\AuthController::class,'logout'])->name('get.logout');
    Route::get('quen-mat-khau',[Frontend\AuthController::class,'restartPassword'])->name('get.restart_password');
    Route::post('quen-mat-khau',[Frontend\AuthController::class,'checkRestartPassword']);

    Route::get('nhap-mat-khau',[Frontend\AuthController::class,'nhapMk'])->name('get.nhapMK');
    Route::post('nhap-mat-khau',[Frontend\AuthController::class,'postNhapMk']);
    
    Route::get('thong-bao-cap-khau-moi',[Frontend\AuthController::class,'alertNewPassword'])->name('get.alert_new_password');
    Route::get('mat-khau-moi',[Frontend\AuthController::class,'newPassword'])->name('get.new_password');
    Route::post('mat-khau-moi',[Frontend\AuthController::class,'processNewPassword']);

    Route::get('dang-ky',[Frontend\AuthController::class,'register'])->name('get.register');
    Route::post('dang-ky',[Frontend\AuthController::class,'postRegister']);
});


Route::group(['namespace' => 'User','prefix' => 'account','middleware' => 'check.login.user'], function (){

    Route::group(['prefix' => 'pet'], function (){
        Route::get('',[User\PetController::class,'index'])->name('get_user.pet.index');
        Route::get('create',[User\PetController::class,'create'])->name('get_user.pet.create');
        Route::post('create',[User\PetController::class,'store'])->name('get_user.pet.store');

        Route::get('update/{id}',[User\PetController::class,'edit'])->name('get_user.pet.update');
        Route::post('update/{id}',[User\PetController::class,'update'])->name('get_user.pet.update');
        Route::get('delete/{id}',[User\PetController::class,'delete'])->name('get_user.pet.delete');

        // thử route add pet bằng ajax
        Route::post('',[User\PetController::class,'storeAjax'])->name('get_user.pet.store.ajax');
        
    });

    Route::group(['prefix' => 'story'], function (){
        Route::get('',[User\StoryController::class,'index'])->name('get_user.story.index');
        Route::get('create',[User\StoryController::class,'create'])->name('get_user.story.create');
        Route::post('create',[User\StoryController::class,'store'])->name('get_user.story.store');

        Route::get('update/{id}',[User\StoryController::class,'edit'])->name('get_user.story.update');
        Route::post('update/{id}',[User\StoryController::class,'update'])->name('get_user.story.update');
        Route::get('delete/{id}',[User\StoryController::class,'delete'])->name('get_user.story.delete');
    });

    Route::group(['prefix' => 'article'], function (){
        Route::get('',[User\ArticleController::class,'index'])->name('get_user.article.index');
        Route::get('create',[User\ArticleController::class,'create'])->name('get_user.article.create');
        Route::post('create',[User\ArticleController::class,'store'])->name('get_user.article.store');

        Route::get('update/{id}',[User\ArticleController::class,'edit'])->name('get_user.article.update');
        Route::post('update/{id}',[User\ArticleController::class,'update'])->name('get_user.article.update');
        Route::get('delete/{id}',[User\ArticleController::class,'delete'])->name('get_user.article.delete');
    });

    Route::group(['prefix' => 'article-blog'], function (){
        Route::get('',[User\ArticleBlogController::class,'index'])->name('get_user.article_blog.index');
        Route::get('create',[User\ArticleBlogController::class,'create'])->name('get_user.article_blog.create');
        Route::post('create',[User\ArticleBlogController::class,'store'])->name('get_user.article_blog.store');

        Route::get('update/{id}',[User\ArticleBlogController::class,'edit'])->name('get_user.article_blog.update');
        Route::post('update/{id}',[User\ArticleBlogController::class,'update'])->name('get_user.article_blog.update');
        Route::get('delete/{id}',[User\ArticleBlogController::class,'delete'])->name('get_user.article_blog.delete');
    });

    Route::get('',[User\AccountController::class,'account'])->name('get.account');
    Route::post('',[User\AccountController::class,'updateProfile']);

    Route::get('follow/{id}',[User\AccountController::class,'followUser'])->name('user.follow');
    Route::get('un-follow/{id}',[User\AccountController::class,'unFollowUser'])->name('user.un_follow');

    Route::get('update-password',[User\AccountController::class,'updatePassword'])->name('get_user.profile.update_password');
    Route::post('update-password',[User\AccountController::class,'processUpdatePassword']);

    Route::get('dang-xuat',[User\AccountController::class,'logout'])->name('get.logout.user');
});


// route sd Ajax
Route::post('/load-more-articles', [Frontend\HomeController::class,'loadMoreArticles'])->name('load.more.articles');
// Route::post('/create-pet-ajax', [User\PetController::class,'storeAjax'])->name('get_user.pet.store.ajax');

Route::get('/verify/{token}', [Frontend\AuthController::class,'verify'])->name('get.verify_account');


Route::get('/notifications/load', [User\NotificationController::class, 'loadNotifications']);
Route::get('/notifications/load-more', [User\NotificationController::class, 'loadMoreNotifications']);

// su dung ajax de hien thi chi tiet bai viet
Route::get('/api/article/{id}', [User\ArticleController::class,'showDetailUseAjax'])->name('get_user.article.showDetailUseAjax');
 