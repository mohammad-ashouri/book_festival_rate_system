<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserManager;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\MenuMiddleware;
use App\Http\Middleware\NTCPMiddleware;
use App\Http\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


//Login Routes
Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    return redirect()->route('dashboard');
});
Route::get('/home', function () {
    Auth::logout();
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::middleware(ThrottleRequests::class)->post('/login', [LoginController::class, 'login']);
Route::get('/captcha', [LoginController::class, 'getCaptcha'])->name('captcha');

//Panel Routes
Route::middleware(CheckLoginMiddleware::class)->middleware(MenuMiddleware::class)->group(function () {
    Route::get('/date', [DashboardController::class, 'jalaliDate'])->name('getNow');
    Route::get('/ChangePassword', [DashboardController::class, 'ChangePassword'])->name('ChangePassword');
    Route::post('/ChangePasswordInc', [DashboardController::class, 'ChangePasswordInc'])->name('ChangePasswordInc');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(NTCPMiddleware::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        //Search Route
        Route::middleware('roleAuthorization:1')->group(function () {
            Route::get('/Search', [SearchController::class, 'search'])->name('Search');
            //User Manager
            Route::get('/UserManager', [UserManager::class, 'index'])->name('UserManager');
            Route::get('/GetUserInfo', [UserManager::class, 'getUserInfo'])->name('GetUserInfo');
            Route::Post('/NewUser', [UserManager::class, 'newUser'])->name('NewUser');
            Route::Post('/EditUser', [UserManager::class, 'editUser'])->name('EditUser');
            Route::Post('/ChangeUserActivationStatus', [UserManager::class, 'changeUserActivationStatus'])->name('ChangeUserActivationStatus');
            Route::Post('/ChangeUserNTCP', [UserManager::class, 'ChangeUserNTCP'])->name('ChangeUserNTCP');
            Route::Post('/ResetPassword', [UserManager::class, 'ResetPassword'])->name('ResetPassword');

            Route::get('/Person', [PersonController::class, 'index'])->name('Person');
            Route::post('/newPerson', [PersonController::class, 'newPerson'])->name('newPerson');
            Route::get('/getPersonInfo', [PersonController::class, 'getPersonInfo'])->name('getPersonInfo');
            Route::post('/editPerson', [PersonController::class, 'editPerson'])->name('editPerson');

            Route::get('/Posts', [PostController::class, 'index'])->name('Posts');
            Route::post('/newPost', [PostController::class, 'newPost'])->name('newPost');
            Route::get('/getPostInfo', [PostController::class, 'getPostInfo'])->name('getPostInfo');
            Route::post('/editPost', [PostController::class, 'editPost'])->name('editPost');

            Route::get('/Classification', [PostController::class, 'showClassification'])->name('Classification');
            Route::post('/changeScientificGroup', [PostController::class, 'changeScientificGroup'])->name('changeScientificGroup');
            Route::post('/Classification', [PostController::class, 'Classification']);

        });
        Route::middleware('roleAuthorization:2')->group(function () {
        });

    });
});

