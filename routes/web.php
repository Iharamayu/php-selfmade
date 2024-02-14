<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserSearchController;
use App\Http\Controllers\Auth\SettingController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//画面編集用
Route::get('/edit',function(){
    return view('setting_profile_complete');
});

//ログイン画面
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

//新規登録画面
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register/confirm', [RegisterController::class, 'confirmRegister'])->name('register.confirm');
Route::post('/register/confirm/complete', [RegisterController::class, 'completeRegister'])->name('register.complete');

//投稿画面
Route::get('/post', [PostController::class, 'showPostForm'])->name('post');
Route::post('/post/confirm', [PostController::class, 'confirmPost'])->name('post.confirm');
Route::post('/top', [PostController::class, 'completePost'])->name('post.complete');

Route::get('/top', [PostController::class, 'showIndex'])->name('top');
//タグ
Route::post('/tag', [PostController::class, 'searchTag'])->name('tag');
//マイページ
Route::get('/mypage', [MyPageController::class, 'showMyPage'])->name('mypage');
//フレンドリスト
Route::get('/mypage/{id}/list', [UserSearchController::class, 'friendsList'])->name('list');

//友達追加ページ
Route::get('/mypage/add', [UserSearchController::class, 'showSearchPage'])->name('search');
Route::post('/search', [UserSearchController::class, 'search'])->name('user.search');
Route::get('/search/result', [UserSearchController::class, 'showSearchResult'])->name('search.result');
Route::post('/user/add/{user}', [UserSearchController::class, 'addUser'])->name('user.add');

//共有日記ページ
Route::get('/share', [PostController::class, 'sharedDiaries'])->name('shared_diaries');

//設定ページ
Route::get('/mypage/setting', [MyPageController::class, 'showSettingPage'])->name('setting');
//プロフィール設定画面表示
Route::get('/setting/profile', [SettingController::class, 'showSettingProfile'])->name('profile');
//プロフィール確認画面
Route::post('/setting/profile/confirm', [SettingController::class, 'confirmProfile'])->name('profile.confirm');
//プロフィール完了画面
Route::post('/setting/profile/confirm/complete', [SettingController::class, 'update'])->name('profile.complete');
//パスワード変更画面
Route::get('/setting/password', [ResetPasswordController::class, 'showSettingPassword'])->name('password');
Route::post('/setting/password/update', [ResetPasswordController::class, 'updatePassword'])->name('password');

//アカウント消去
Route::post('/delete-user/{id}', [SettingController::class, 'deleteUser'])->name('user.delete');


//管理画面
Route::get('/admin', [AdminController::class, 'showAdmin'])->name('admin');
//詳細画面
Route::get('/admin/detail/{id}',[AdminController::class,'showDetail'])->name('detail');
//ユーザー消去
Route::post('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
