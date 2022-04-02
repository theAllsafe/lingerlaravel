<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Apis; 
use App\Http\Controllers\ApiController; 

//import Admin controller
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\TimeSlotController;
use App\Http\Controllers\Admin\HomeSettingController;
use App\Http\Controllers\Admin\QuizzInfoController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\LeaderboardController;
use App\Http\Controllers\Admin\AdminSukoonController;
use App\Http\Controllers\Admin\AdminSunnahController;
use App\Http\Controllers\Admin\LibraryAudioController;
use App\Http\Controllers\Admin\LibraryBookController;
use App\Http\Controllers\Admin\LibraryChapterController;
use App\Http\Controllers\Admin\OtherUserController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminDuaWazifaController;
use App\Http\Controllers\Admin\AdminIslamicFestivalsController;
use App\Http\Controllers\Admin\AdminIslamicHeroesController;

//import AppApi controller
use App\Http\Controllers\AppApi\AuthController;
use App\Http\Controllers\AppApi\ResetPasswordController;
use App\Http\Controllers\AppApi\QuizzController;
use App\Http\Controllers\AppApi\SukoonController;
use App\Http\Controllers\AppApi\SunnahController;
use App\Http\Controllers\AppApi\BabyNamesController;
use App\Http\Controllers\AppApi\LibraryController;
    Route::post('/signin', [AuthController::class, 'signin']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/social-media-signin', [AuthController::class, 'google_signin']);
    Route::post('/mobile-otp-signin', [AuthController::class, 'mobile_otp_signin']);
    Route::post('otp-verification', [AuthController::class, 'otp_verification']);
    Route::post('/reset-password-mobile', [ResetPasswordController::class, 'reset_password_mobile']);
    Route::post('/reset-password-email', [ResetPasswordController::class, 'reset_password_email']);
    Route::post('/update-password', [ResetPasswordController::class, 'update_password']);
Route::prefix('user')->group(function(){
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/otp_verification', [AuthController::class, 'otp_verification']);
    
    Route::middleware('auth:api')->group( function () {
        Route::post('home', [QuizzController::class, 'home']);
        //Quizz
        Route::post('note', [QuizzController::class, 'note']);
        Route::post('question', [QuizzController::class, 'question']);
        Route::post('answer', [QuizzController::class, 'answer']);
        Route::post('result', [QuizzController::class, 'result']);
        
        //Profile
        Route::post('profile-image', [AuthController::class, 'update_profile_image']);
        Route::post('delete-profile-image', [AuthController::class, 'delete_profile_image']);
        Route::post('profile-update', [AuthController::class, 'profile_update']);
        Route::get('personal-profile', [AuthController::class, 'personal_profile']);
        Route::get('other-user-profile/{id}', [AuthController::class, 'other_user_profile']);
        Route::post('like', [AuthController::class, 'like']);
        Route::post('follow', [AuthController::class, 'follow']);
        
        //Sunnah
        Route::get('sunnah', [SunnahController::class, 'index']);
        Route::get('sunnah-details/{id}', [SunnahController::class, 'details']);
        
        //Sukoon
        Route::get('sukoon', [SukoonController::class, 'index']);
        Route::get('sukoon-details/{id}', [SukoonController::class, 'details']);
        Route::post('sukoon-like', [SukoonController::class, 'like']);

        //baby names
        Route::post('request-baby-name', [BabyNamesController::class, 'store']);
        Route::post('reply-baby-name', [BabyNamesController::class, 'reply']);
        //Quran
        Route::get('quran', [QuranController::class, 'quran']);
        Route::post('quran-details', [QuranController::class, 'quran_details']);
        Route::post('quran-search', [QuranController::class, 'quran_search']);
        //library
        Route::get('library', [LibraryController::class, 'index']);
        Route::get('library/audio/details/{id}', [LibraryController::class, 'details']);
        Route::get('library/book/details/{id}', [LibraryController::class, 'book_details']);
    });

    
});
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/first-api',[Apis::class,'firstApi']); 

Route::get('/second-api/{id}',[Apis::class,'secondApi']); 

Route::post('/post-api',[Apis::class,'postApi']); 

Route::get('/taskList',[Apis::class,'getTaskList']); 

Route::get('/singleTask/{id}',[Apis::class,'getSingleTaskList']); 

//// PASSPORT //////


Route::post('/register',[Apis::class,'register']); 

Route::post('/login',[ApiController::class,'login']);

Route::get('/login',[ApiController::class,'login'::class,'login'])->name('login');

Route::get('/punchout',[ApiController::class,'punchout'::class,'punchout'])->name('punchout');

//login Admin
// Route::post('/signin', [AuthenticationController::class, 'signin']);
// Route::get('/', [AuthenticationController::class, 'signin']);
//using middleware
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/admin-signin', [AdminAuthController::class, 'signin']);
Route::prefix('admin')->group(function(){

    Route::post('homeSetting/store', [HomeSettingController::class, 'store']);
    Route::delete('homeSetting/destroy/{id}', [HomeSettingController::class, 'destroy']);
    Route::get('homeSetting/{id}', [HomeSettingController::class, 'index']);
    Route::post('homeSetting/islam/update', [HomeSettingController::class, 'islam_update']);

    //DuaWazifa
    Route::get('duaWazifa', [AdminDuaWazifaController::class, 'index']);
    Route::post('duaWazifa/store', [AdminDuaWazifaController::class, 'store']);
    Route::get('duaWazifa/edit/{id}', [AdminDuaWazifaController::class, 'edit']);
    Route::put('duaWazifa/update/{id}', [AdminDuaWazifaController::class, 'update']);
    Route::delete('duaWazifa/destroy/{id}', [AdminDuaWazifaController::class, 'destroy']);
    //Islamic Festivals
    Route::get('islamicFestivals', [AdminIslamicFestivalsController::class, 'index']);
    Route::post('islamicFestivals/store', [AdminIslamicFestivalsController::class, 'store']);
    Route::get('islamicFestivals/edit/{id}', [AdminIslamicFestivalsController::class, 'edit']);
    Route::put('islamicFestivals/update/{id}', [AdminIslamicFestivalsController::class, 'update']);
    Route::delete('islamicFestivals/destroy/{id}', [AdminIslamicFestivalsController::class, 'destroy']);
    //Islamic Festivals
    Route::get('islamicHeroes', [AdminIslamicHeroesController::class, 'index']);
    Route::post('islamicHeroes/store', [AdminIslamicHeroesController::class, 'store']);
    Route::get('islamicHeroes/edit/{id}', [AdminIslamicHeroesController::class, 'edit']);
    Route::put('islamicHeroes/update/{id}', [AdminIslamicHeroesController::class, 'update']);
    Route::delete('islamicHeroes/destroy/{id}', [AdminIslamicHeroesController::class, 'destroy']);

    Route::get('islamicHeroestype/islamicHeroes', [AdminIslamicHeroesController::class, 'islamicHeroes']);
    Route::get('islamicHeroestype', [AdminIslamicHeroesController::class, 'type']);
    Route::post('islamicHeroestype/store', [AdminIslamicHeroesController::class, 'store_type']);
    Route::get('islamicHeroestype/edit/{id}', [AdminIslamicHeroesController::class, 'edit']);
    Route::put('islamicHeroestype/update/{id}', [AdminIslamicHeroesController::class, 'update']);
    Route::delete('islamicHeroestype/destroy/{id}', [AdminIslamicHeroesController::class, 'destroy_type']);

    Route::get('babyNames', [HomeSettingController::class, 'babyNames']);
    Route::get('khwabkiTabeer', [HomeSettingController::class, 'khwabkiTabeer']);

    Route::get('other-user', [OtherUserController::class, 'index']);
    Route::post('other-user/store', [OtherUserController::class, 'store']);
    Route::get('other-user/edit/{id}', [OtherUserController::class, 'edit']);
    Route::put('other-user/update/{id}', [OtherUserController::class, 'update']);
    Route::delete('other-user/destroy/{id}', [OtherUserController::class, 'destroy']);

    Route::get('course', [AdminCourseController::class, 'index']);
    Route::post('course/store', [AdminCourseController::class, 'store']);
    Route::get('course/edit/{id}', [AdminCourseController::class, 'edit']);
    Route::put('course/update/{id}', [AdminCourseController::class, 'update']);
    Route::delete('course/destroy/{id}', [AdminCourseController::class, 'destroy']);
    
    Route::get('course-setting', [AdminCourseController::class, 'setting']);
    Route::post('course-setting/update', [AdminCourseController::class, 'setting_update']);

    Route::get('season', [SeasonController::class, 'index']);
    Route::post('season/store', [SeasonController::class, 'store']);
    Route::get('season/edit/{id}', [SeasonController::class, 'edit']);
    Route::put('season/update/{id}', [SeasonController::class, 'update']);
    Route::get('season/destroy/{id}', [SeasonController::class, 'destroy']);

    Route::get('question', [QuestionController::class, 'index']);
    Route::get('question/season', [QuestionController::class, 'season']);
    Route::post('question/store', [QuestionController::class, 'store']);
    Route::post('question/storeExcel', [QuestionController::class, 'storeExcel']);
    Route::get('question/edit/{id}', [QuestionController::class, 'edit']);
    Route::put('question/update/{id}', [QuestionController::class, 'update']);
    Route::get('question/destroy/{id}', [QuestionController::class, 'destroy']);
    Route::post('question/otp-request', [QuestionController::class, 'otp_request']);

    Route::get('subscription', [SubscriptionController::class, 'index']);
    Route::post('subscription/store', [SubscriptionController::class, 'store']);
    Route::get('subscription/edit/{id}', [SubscriptionController::class, 'edit']);
    Route::put('subscription/update/{id}', [SubscriptionController::class, 'update']);
    Route::get('subscription/destroy/{id}', [SubscriptionController::class, 'destroy']);
    Route::post('subscription/status', [SubscriptionController::class, 'status']);

    Route::get('quizzinfo', [QuizzInfoController::class, 'index']);
    Route::post('quizzinfo/store', [QuizzInfoController::class, 'store']);
    Route::get('quizzinfo/edit/{id}', [QuizzInfoController::class, 'edit']);
    Route::put('quizzinfo/update/{id}', [QuizzInfoController::class, 'update']);
    Route::get('quizzinfo/destroy/{id}', [QuizzInfoController::class, 'destroy']);
    Route::post('quizzinfo/status', [QuizzInfoController::class, 'status']);

    Route::get('result/{id}', [QuizzInfoController::class, 'result']);

    Route::get('timeslot', [TimeSlotController::class, 'index']);
    Route::post('timeslot/store', [TimeSlotController::class, 'store']);
    Route::get('timeslot/edit/{id}', [TimeSlotController::class, 'edit']);
    Route::put('timeslot/update/{id}', [TimeSlotController::class, 'update']);
    Route::get('timeslot/destroy/{id}', [TimeSlotController::class, 'destroy']);
    Route::post('timeslot/status', [TimeSlotController::class, 'status']);
    
    Route::get('sukoon', [AdminSukoonController::class, 'index']);
    Route::post('sukoon/store', [AdminSukoonController::class, 'store']);
    Route::get('sukoon/edit/{id}', [AdminSukoonController::class, 'edit']);
    Route::put('sukoon/update/{id}', [AdminSukoonController::class, 'update']);
    Route::delete('sukoon/destroy/{id}', [AdminSukoonController::class, 'destroy']);
    Route::post('sukoon/status', [AdminSukoonController::class, 'status']);

    Route::get('sunnah', [AdminSunnahController::class, 'index']);
    Route::post('sunnah/store', [AdminSunnahController::class, 'store']);
    Route::get('sunnah/edit/{id}', [AdminSunnahController::class, 'edit']);
    Route::put('sunnah/update/{id}', [AdminSunnahController::class, 'update']);
    Route::delete('sunnah/destroy/{id}', [AdminSunnahController::class, 'destroy']);
    Route::post('sunnah/status', [AdminSunnahController::class, 'status']);

    Route::get('library/audio', [LibraryAudioController::class, 'index']);
    Route::post('library/audio/store', [LibraryAudioController::class, 'store']);
    Route::get('library/audio/edit/{id}', [LibraryAudioController::class, 'edit']);
    Route::put('library/audio/update/{id}', [LibraryAudioController::class, 'update']);
    Route::delete('library/audio/destroy/{id}', [LibraryAudioController::class, 'destroy']);
    
    Route::get('library/book', [LibraryBookController::class, 'index']);
    Route::post('library/book/store', [LibraryBookController::class, 'store']);
    Route::get('library/book/edit/{id}', [LibraryBookController::class, 'edit']);
    Route::put('library/book/update/{id}', [LibraryBookController::class, 'update']);
    Route::delete('library/book/destroy/{id}', [LibraryBookController::class, 'destroy']);

    Route::get('library/chapter', [LibraryChapterController::class, 'index']);
    Route::get('library/chapter/book', [LibraryChapterController::class, 'book']);
    Route::post('library/chapter/store', [LibraryChapterController::class, 'store']);
    Route::get('library/chapter/edit/{id}', [LibraryChapterController::class, 'edit']);
    Route::put('library/chapter/update/{id}', [LibraryChapterController::class, 'update']);
    Route::delete('library/chapter/destroy/{id}', [LibraryChapterController::class, 'destroy']);

    Route::get('allusers', [LeaderboardController::class, 'index']);
});
 // );