<?php

use App\Http\Controllers\AssessmentRaterController;
use App\Http\Controllers\BranchInfo\InterviewController;
use App\Http\Controllers\Catalogs\DefencePlaceController;
use App\Http\Controllers\Catalogs\FestivalController;
use App\Http\Controllers\Catalogs\LanguageController;
use App\Http\Controllers\Catalogs\PublisherController;
use App\Http\Controllers\Catalogs\ScientificGroupController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\Reports\AssessmentsReport;
use App\Http\Controllers\Reports\DeliveryReportController;
use App\Http\Controllers\Reports\PDFController;
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
            Route::resource('Users', UserManager::class);
            Route::get('/GetUserInfo', [UserManager::class, 'getUserInfo'])->name('GetUserInfo');
            Route::Post('/NewUser', [UserManager::class, 'newUser'])->name('NewUser');
            //End User Manager

            //Catalogs
            Route::get('/getLanguageInfo', [LanguageController::class, 'getLanguageInfo']);
            Route::get('/getScientificGroupInfo', [ScientificGroupController::class, 'getScientificGroupInfo']);
            Route::get('/getFestivalInfo', [FestivalController::class, 'getFestivalInfo']);
            Route::get('/getAllGroups', [ScientificGroupController::class, 'getAllGroups']);
            Route::resource('Publishers', PublisherController::class);
            Route::resource('Festivals', FestivalController::class);
            Route::resource('DefencePlaces', DefencePlaceController::class);
            Route::resource('Languages', LanguageController::class);

            //End Catalogs

            //Person Management
            Route::resource('Person', PersonController::class);
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
            Route::get('/Classification', [ClassificationController::class, 'showClassification']);
            Route::post('/changeScientificGroup', [ClassificationController::class, 'changeScientificGroup']);
            Route::post('/Classification', [ClassificationController::class, 'Classification']);
            //End Classification Management

            Route::get('/SummaryAssessmentFormApproval', [AssessmentRaterController::class, 'headerApprovalIndex']);
            Route::post('/ApprovePost', [AssessmentRaterController::class, 'headerApprove']);
            Route::get('/DetailedAssessmentFormApproval', [AssessmentRaterController::class, 'detailedAssessmentFormApprovalIndex']);
            Route::post('/DetailedAssessmentFormApproval', [AssessmentRaterController::class, 'detailedAssessmentFormApproval']);

            //Assessment Management
            Route::get('/SummaryAssessmentManager', [AssessmentRaterController::class, 'summaryAssessmentIndex']);
            Route::post('/SetSummaryRater', [AssessmentRaterController::class, 'setSummaryRater']);
            Route::get('/DetailedAssessmentManager', [AssessmentRaterController::class, 'detailedAssessmentIndex']);
            Route::post('/SetDetailedRater', [AssessmentRaterController::class, 'setDetailedRater']);
            Route::get('/FormalLiteraryAssessmentManager', [AssessmentRaterController::class, 'formalLiteraryAssessmentIndex']);
            Route::post('/SetFormalLiteraryRater', [AssessmentRaterController::class, 'setFormalLiteraryRater']);

            //Reports Management
            Route::group(['prefix' => 'AssessmentsStatus'], static function () {
                Route::get('/', [AssessmentsReport::class, 'allAssessmentReportIndex']);
                Route::post('/', [AssessmentsReport::class, 'reportAssessments']);
            });
            Route::group(['prefix' => 'DeliveryStatus'], static function () {
                Route::get('/', [DeliveryReportController::class, 'index']);
                Route::get('/Show', [DeliveryReportController::class, 'show']);
                Route::post('/', [DeliveryReportController::class, 'new']);
                Route::post('/Edit', [DeliveryReportController::class, 'edit']);
                Route::post('/Delete', [DeliveryReportController::class, 'delete']);
            });
            Route::group(['prefix' => 'ReportComment'], static function () {
                Route::post('/', [DeliveryReportController::class, 'newComment']);
                Route::get('/', [DeliveryReportController::class, 'getComments']);
                Route::post('/Edit', [DeliveryReportController::class, 'edit']);
                Route::post('/Delete', [DeliveryReportController::class, 'deleteComment']);
            });

            Route::post('/GeneratePDF', [PDFController::class, 'generatePDF']);
        });

        Route::middleware('roleAuthorization:3')->group(function () {
            Route::get('/Approval', [AssessmentRaterController::class, 'headerApprovalIndex']);
            Route::post('/Approve', [AssessmentRaterController::class, 'headerApprove']);
        });
        Route::middleware('roleAuthorization:5')->group(function () {
            Route::get('/MyClassification', [ClassificationController::class, 'showClassification']);
            Route::post('/changeMyScientificGroup', [ClassificationController::class, 'changeScientificGroup']);
            Route::post('/MyClassification', [ClassificationController::class, 'Classification']);
        });

        Route::group(['prefix' => 'Rate'], static function () {
            Route::get('/Summary/{id}', [RateController::class, 'summaryIndex']);
            Route::post('/setSummaryRate', [RateController::class, 'setSummaryRate']);
            Route::get('/FormalLiterary/{id}', [RateController::class, 'formalLiteraryIndex']);
            Route::post('/setFormalLiteraryRate', [RateController::class, 'setFormalLiteraryRate']);
            Route::get('/Detailed/{id}', [RateController::class, 'detailedIndex']);
            Route::post('/setDetailedRate', [RateController::class, 'setDetailedRate']);
        });

    });
});

