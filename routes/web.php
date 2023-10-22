<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\Catalogs\FestivalController;
use App\Http\Controllers\Catalogs\LanguageController;
use App\Http\Controllers\Catalogs\ScientificGroupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RateController;
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
    Route::get('/Profile', [DashboardController::class, 'Profile'])->name('Profile');
    Route::post('/ChangePasswordInc', [DashboardController::class, 'ChangePasswordInc']);
    Route::post('/ChangeUserImage', [DashboardController::class, 'ChangeUserImage']);
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
            //End User Manager

            //Catalogs
            Route::get('/getLanguageInfo', [LanguageController::class, 'getLanguageInfo']);
            Route::get('/getScientificGroupInfo', [ScientificGroupController::class, 'getScientificGroupInfo']);
            Route::get('/getFestivalInfo', [FestivalController::class, 'getFestivalInfo']);
            Route::get('/getAllGroups', [ScientificGroupController::class, 'getAllGroups']);
            //End Catalogs

            //Person Management
            Route::get('/Person', [PersonController::class, 'index']);
            Route::post('/newPerson', [PersonController::class, 'newPerson'])->name('newPerson');
            Route::get('/getPersonInfo', [PersonController::class, 'getPersonInfo']);
            Route::post('/editPerson', [PersonController::class, 'editPerson']);
            //End Person Management

            //Post Management
            Route::get('/Posts', [PostController::class, 'index']);
            Route::post('/newPost', [PostController::class, 'newPost']);
            Route::get('/getPostInfo', [PostController::class, 'getPostInfo']);
            Route::get('/getParticipants', [PostController::class, 'getParticipants']);
            Route::post('/editPost', [PostController::class, 'editPost']);
            Route::delete('/deletePost', [PostController::class, 'deletePost']);
            //End Post Management

            //Classification Management
            Route::get('/Classification', [PostController::class, 'showClassification']);
            Route::post('/changeScientificGroup', [PostController::class, 'changeScientificGroup']);
            Route::post('/Classification', [PostController::class, 'Classification']);
            //End Classification Management

            Route::get('/SummaryAssessmentManager', [AssessmentController::class, 'summaryAssessmentIndex']);
            Route::post('/SetSummaryRater', [AssessmentController::class, 'setSummaryRater']);
        });
        Route::middleware('roleAuthorization:4')->group(function () {

        });


        Route::group(['prefix' => 'Rate'], static function () {
            Route::get('/Summary/{id}', [RateController::class, 'summaryIndex']);
            Route::post('/setSummaryRate', [RateController::class, 'setSummaryRate']);
        });

    });
});

