<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\DoubtController;
use App\Http\Controllers\Admins\RoleController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\User\FriendController;
use App\Http\Controllers\User\MemberController;
use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProjectController;
use App\Http\Controllers\User\DonationController;
use App\Http\Controllers\User\PostLikeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\CommentLikeController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\SubscriptionController;
use App\Http\Controllers\Admins\AdminDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


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

Route::middleware(['guest'])->get('/', [WelcomeController::class, 'show'])->name('welcome');

/****************** RUTAS PARA USUARIOS NORMALES **************/

Route::middleware(['auth:sanctum', 'verified'])->prefix('user')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('profiles')->name('profiles.')->group(function () {
        Route::get('profile/{user:username}', [ProfileController::class, 'show'])->name('show');
        Route::get('profile/{user:username}/checkout', [DonationController::class, 'checkout'])->name('checkout');
        Route::post('/', [PaymentController::class, 'store'])->name('store'); 
    });

    Route::get('members', [MemberController::class, 'index'])->name('members.index');
    
    Route::prefix('friends')->name('friends.')->group(function () {
        Route::get('', [FriendController::class, 'index'])->name('index');
        Route::post('/{user}', [FriendController::class, 'store'])->name('store');
        Route::patch('/{user}', [FriendController::class, 'update'])->name('update');
        Route::get('/{user}', [FriendController::class, 'deny'])->name('deny');
        Route::delete('/{user}', [FriendController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('posts')->name('posts.')->group(function () {
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('post-like')->name('post-like.')->group(function(){
        Route::post('/{post}',[PostLikeController::class, 'store'])->name('store');
        Route::delete('/{post}',[PostLikeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('comments')->name('comments.')->group(function () {
        Route::post('/{post}/comments', [CommentController::class, 'store'])->name('store');
    });

    Route::prefix('comment-like')->name('comment-like.')->group(function(){
        Route::post('/{comment}',[CommentLikeController::class, 'store'])->name('store');
        Route::delete('/{comment}',[CommentLikeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('notifications')->name('notifications.')->group(function() {
        Route::post('/mark-one/{id}', [NotificationController::class, 'store'])->name('store');
        Route::get('/mark-all', [NotificationController::class, 'update'])->name('update');
        Route::get('/mark-delete/{id}', [NotificationController::class, 'destroy'])->name('destroy');
    });

    Route::middleware(['subscription'])->prefix('projects')->name('projects.')->group(function(){
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::post('/put', [ProjectController::class, 'store'])->name('store');
        Route::get('/get/{project:id}', [ProjectController::class, 'download'])->name('download');
    });

    Route::middleware(['subscription'])->prefix('doubts')->name('doubts.')->group(function() {
        Route::get('/', [DoubtController::class, 'index'])->name('index');
        Route::post('/', [DoubtController::class,'store_doubt'])->name('store_doubt');
        Route::get('/{doubt:slug}', [DoubtController::class, 'show'])->name('show');
        Route::post('/{doubt:slug}/messages', [DoubtController::class, 'store'])->name('store');
        Route::patch('/{doubt:slug}', [DoubtController::class, 'update'])->name('update');
    });

    Route::prefix('subscription')->name('subscription.')->group(function () {
        Route::get('', [SubscriptionController::class, 'index'])->name('index');
        Route::get('checkout', [SubscriptionController::class, 'checkout'])->name('checkout');
        Route::post('/', [PaymentController::class, 'store'])->name('store');
    });

    Route::get('/about', function () {
        return Inertia::render('User/About/Index');
    })->name('about.index');

    Route::get('/help', function () {
        return Inertia::render('User/Help/Index');
    })->name('help.index');


});


/********************* RUTAS PARA ADMINS ***********************/

Route::prefix('admin')->middleware(['auth:sanctum', 'verified', 'can:accessAdmins'])->name('admin.')->group(function () {

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('roles')->resource('roles', RoleController::class);

    Route::prefix('admins')->resource('admins', AdminController::class)->parameters(['admins' => 'user'])->only(['index', 'edit', 'update']);

    Route::prefix('users')->resource('users', UserController::class)->only(['index', 'edit', 'update']);
    
     
});

/**************** RUTAS AUTH ***********************************/


Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {

    $limiter = config('fortify.limiters.login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:' . config('fortify.guard'),
            $limiter ? 'throttle:' . $limiter : null,
        ]));
});
