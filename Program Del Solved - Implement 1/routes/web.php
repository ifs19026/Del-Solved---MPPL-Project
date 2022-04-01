<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\RequestController;

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

Route::get('/', 'App\Http\Controllers\FrontendController@index');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/new-topic', function () {
    return view('client.new-topic');
});

Route::get('/category/overview/{id}', [FrontendController::class, 'categoryOverview'])->name('category.overview');

Route::get('/forum/overview/{id}', [FrontendController::class,'forumOverview'])->name('forum.overview');

/**
 * route delete topic by admin
 */
Route::get('/forum/overview/delete/{id}', [FrontendController::class, 'deleteTopic']);

Route::middleware(['auth','admin'])->group(function () {
    route::get('dashboard/home', [DashboardController::class, 'home']);
    route::get('dashboard/category/new', [CategoryController::class,'create'])->name('category.new');
    route::post('dashboard/category/new', [CategoryController::class, 'store'])->name('category.store');
    route::get('dashboard/categories', [CategoryController::class,'index'])->name('categories');
    route::get('dashboard/categories/{id}', [CategoryController::class,'show'])->name('category');
    route::get('dashboard/categories/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
    route::post('dashboard/categories/edit/{id}', [CategoryController::class,'update'])->name('category.update');
    route::get('dashboard/categories/delete/{id}', [CategoryController::class,'destroy'])->name('category.destroy');
    // Forums
    route::get('dashboard/forum/new', [ForumController::class,'create'])->name('forum.new');
    route::post('dashboard/forum/new', [ForumController::class,'store'])->name('forum.store');
    route::get('dashboard/forums', [ForumController::class,'index'])->name('forums');

    route::get('dashboard/forums/{id}', [ForumController::class,'edit'])->name('forum');
    route::get('dashboard/forums/edit/{id}', [ForumController::class,'edit'])->name('forum.edit');
    route::post('dashboard/forums/update/{id}', [ForumController::class,'update'])->name('forum.update');
    route::get('dashboard/forums/delete/{id}', [ForumController::class,'destroy'])->name('forum.destroy');
    Route::get('/dashboard/users', [DashboardController::class,'users']);
    Route::get('/dashboard/admin/profile', [DashboardController::class,'profile'])->name('admin.profile');
    ;
    Route::get('/dashboard/users/{id}', [DashboardController::class,'show']);
    Route::post('/dashboard/users/{id}', [DashboardController::class,'destroy'])->name('user.delete');

    Route::get('/dashboard/notifications', [DashboardController::class,'notifications'])->name('notifications');
    Route::get('/dashboard/notifications/mark-as-read/{id}', [DashboardController::class,'markAsRead'])->name('notification.read');
    Route::get('/dashboard/notifications/delete/{id}', [DashboardController::class,'notificationDestroy'])->name('notification.delete');
    Route::get('/dashboard/settings/form', [DashboardController::class,'settingsForm'])->name('settings.form');
    Route::post('/dashboard/settings/new', [DashboardController::class,'newSetting'])->name('settings.new');
});


// Topics
route::get('client/topic/new/{id}', [DiscussionController::class,'create'])->name('topic.new');
route::post('client/topic/new', [DiscussionController::class,'store'])->name('topic.store');
route::get('client/topic/{id}', [DiscussionController::class,'show'])->name('topic');
route::post('client/topic/{id}', [DiscussionController::class,'reply'])->name('topic.reply');
route::get('client/topic/remove/{id}', [DiscussionController::class,'remove'])->name('topic.delete');
route::get('/topic/reply/delete/{id}', [DiscussionController::class,'destroy'])->name('reply.delete');

Route::get('/updates', [DiscussionController::class,'updates']);
Route::post('user/update/{id}', [UserController::class,'update'])->name("user.update");

// users
route::get('/client/user/{id}', [FrontendController::class,'profile'])->middleware('auth')->name('client.user.profile');
route::get('/client/users', [FrontendController::class,'users'])->middleware('auth')->name('client.users');
route::post('user/photo/update/{id}', [FrontendController::class,'photoUpdate'])->name('user.photo.update');

route::post('topics/sort', [DiscussionController::class,'sort'])->name('topics.sort');

route::get('reply/like/{id}', [DiscussionController::class,'like'])->name('reply.like');
route::get('reply/dislike/{id}', [DiscussionController::class,'dislike'])->name('reply.dislike');
route::post('category/search', [CategoryController::class,'search'])->name('category.search');

route::get('blog/home', [BlogController::class,'home'])->name('blog.home');




/**
 * route untuk request category
 */
route::get('request/category', [RequestController::class, 'show_category_view']);
route::post('request/category/store', [RequestController::class, 'store_request_category'])->name('request.category.store');

/**
 * route untuk request forum
 */
route::get('request/forum', [RequestController::class, 'show_forum_view']);
route::post('request/forum/store', [RequestController::class, 'store_request_forum'])->name('request.forum.store');

/**
 * route untuk fitur survey
 */
route::get('survey', [SurveyController::class, 'showAllSurvey']);
route::get('survey/showForm', [SurveyController::class, 'showForm']);
route::post('survey/storeSurvey', [SurveyController::class, 'storeSurvey'])->name('store.survey');
route::get('survey/{id}', [SurveyController::class, 'showSurvey']);
route::get('survey/self/{id}', [SurveyController::class, 'showSelfSurvey']);
route::get('survey/self/edit/{id}', [SurveyController::class, 'editSurveyForm']);
route::post('survey/self/storeEdit/{id}', [SurveyController::class, 'storeEditSurvey'])->name('store.edit');
route::get('survey/self/delete/{id}', [SurveyController::class, 'deleteSurvey']);

/**
 * route untuk fitur profil & operasi self discussions
 */
route::get('/home/edit/{id}', [HomeController::class, 'showEditForm']);
route::post('/home/storeEdit/{id}', [HomeController::class, 'storeEdit'])->name('store.edit.discussion');
route::get('/home/delete/{id}', [HomeController::class, 'deleteDiscussion']);




