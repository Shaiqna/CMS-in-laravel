<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\PageController as SitePageController;
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

Route::get('/', [HomeController::class, 'index']);

Route::prefix('painel')->group(function(){
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);

    Route::get('register', [RegisterController::class, 'index'])->name('resgiter');
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('users', UserController::class);
    Route::resource('pages', PageController::class);

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profilesave', [ProfileController::class, 'save'])->name('profile.save');

    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::put('settingssave', [SettingController::class, 'save'])->name('settings.save');
});

Route::fallback([SitePageController::class, 'index']);
