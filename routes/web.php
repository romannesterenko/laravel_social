<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CommunitiesController as AdminCommunitiesController;
use App\Http\Controllers\ComentController;
use App\Http\Controllers\FrontPostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SummernoteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/store_image', [ImageController::class, 'store'])->name('images.store');
Route::post('/store_image_ui', [ImageController::class, 'store_ui'])->name('images.store_ui');
Route::delete('/delete_image', [ImageController::class, 'delete'])->name('images.delete');
Route::delete('/delete_image_ui', [ImageController::class, 'delete_ui'])->name('images.delete_ui');

Route::group(['prefix' => '/posts','as' => 'posts.'], function (){
    Route::post('/quick_add', [FrontPostController::class, 'quick_add'])->name('quick_add');
    Route::post('/like', [LikeController::class, 'store'])->name('like.store');
    Route::post('/getMeta', [FrontPostController::class, 'getMeta'])->name('getMeta');
    Route::post('/add_post', [FrontPostController::class, 'add_post'])->name('add_post');
    Route::post('/update_post/{id}', [FrontPostController::class, 'update_post'])->name('update_post');
    Route::get('/{id}', [FrontPostController::class, 'show'])->name('show');
});
Route::group(['prefix' => '/comments','as' => 'comments.'], function (){
    Route::post('/add', [ComentController::class, 'create_from_ui'])->name('create');
    Route::post('/update/{id}', [ComentController::class, 'update_from_ui'])->name('update');
    Route::delete('/delete/{id}', [ComentController::class, 'remove'])->name('delete');
});
Route::group(['prefix' => '/groups','as' => 'groups.', 'middleware' => 'auth'], function (){
    Route::get('/', [GroupController::class, 'index'])->name('index');
    Route::get('/add', [GroupController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('edit');
    Route::post('/update', [GroupController::class, 'update'])->name('update');
    Route::get('/my', [GroupController::class, 'my'])->name('my');
    Route::get('/subscribed', [GroupController::class, 'subscribed'])->name('subscribed');
    Route::get('/{group_id}/post/{post_is}', [GroupController::class, 'post'])->name('post');
    Route::get('/{group_id}', [GroupController::class, 'detail'])->name('detail');
    Route::get('/{group_id}/subscribers', [GroupController::class, 'subscribers'])->name('subscribers');
    Route::post('/', [GroupController::class, 'store'])->name('store');
    Route::post('/subscribe', [GroupController::class, 'subscribe'])->name('subscribe');
    Route::post('/getMeta', [GroupController::class, 'getMeta'])->name('getMeta');
});
Route::group(['prefix' => '/inbox','as' => 'inbox.', 'middleware' => 'auth'], function (){
    Route::get('/', [InboxController::class, 'index'])->name('index');
    Route::get('/to/{id}', [InboxController::class, 'show'])->name('chat');
    Route::post('/message/to/{id}', [InboxController::class, 'add_message'])->name('message');
    Route::post('/getThreadAjax', [InboxController::class, 'get_thread_ajax'])->name('ajax_thread');
});
Route::group(['prefix' => '/profile','as' => 'profile.', 'middleware' => 'auth'], function (){
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::post('/', [ProfileController::class, 'update'])->name('update');

    Route::group(['prefix' => '/post','as' => 'post.'], function (){
        Route::get('/add', [ProfileController::class, 'add_post'])->name('add');
        Route::get('/edit/{id}', [ProfileController::class, 'edit_post'])->name('edit');
        Route::delete('/delete/{id}', [FrontPostController::class, 'delete'])->name('delete');
    });
});
Route::group(['prefix' => '/panel','as' => 'admin.'], function (){
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::group(['prefix' => 'users', 'as' => 'users.'], function (){
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/create', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'communities', 'as' => 'communities.'], function (){
        Route::group(['prefix' => 'categories', 'as' => 'categories.'], function (){
            Route::get('/', [\App\Http\Controllers\Admin\CommunityCategoriesController::class, 'index'])->name('index');
        });
        Route::get('/', [AdminCommunitiesController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [AdminCommunitiesController::class, 'edit'])->name('edit');
        Route::get('/show/{id}', [AdminCommunitiesController::class, 'show'])->name('show');
    });

    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function (){
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::get('/show/{id}', [PostController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::post('/create', [PostController::class, 'store'])->name('store');
        Route::post('/update/{id}', [PostController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'images', 'as' => 'images.'], function (){
        Route::get('/', [ImageController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'comments', 'as' => 'comments.'], function (){
        Route::get('/', [ComentController::class, 'index'])->name('index');

    });
});

Route::post('summernote/upload', [SummernoteController::class, 'upload'])->name('summernote.upload');
Route::post('summernote/delete', [SummernoteController::class, 'delete'])->name('summernote.delete');

