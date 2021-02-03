<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HeadlineController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Jetstream;

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

Route::get('/dashboard', function () {
    return redirect(route('admin.dashboard'));
});

Route::get('/', function () {
    $content=\App\Models\Content::whereStatus('accepted')->get();
    return view('front.blog',compact('content'));
});

Route::get('/',[ClientController::class,''])->name('index');
Route::get('/tausiyah',[ClientController::class,'tausiyah'])->name('tausiyah');
Route::get('/blog',[ClientController::class,'blog'])->name('blog');
Route::get('/event',[ClientController::class,'event'])->name('event');
Route::get('/about',[ClientController::class,'about'])->name('about');
Route::get('/{slug}',[ClientController::class,'detail'])->name('detail');

Route::name('admin.')->prefix('admin')->middleware(['auth:sanctum','web', 'verified'])->group(function() {
    Route::view('/dashboard', "dashboard")->name('dashboard');

    Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
        Route::group(['middleware' => ['auth', 'verified']], function () {
            // User & Profile...
            Route::get('/user/profile', [UserProfileController::class, 'show'])
                ->name('profile.show');

            // API...
            if (Jetstream::hasApiFeatures()) {
                Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
            }

            // Teams...
            if (Jetstream::hasTeamFeatures()) {
                Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
                Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
                Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');
            }
        });
    });

    Route::resource('tag',TagController::class)->only(['index','create','edit']);
    Route::resource('blog',BlogController::class)->only(['index','create','edit']);
    Route::resource('faq',FaqController::class)->only(['index','create','edit']);
    Route::resource('headline',HeadlineController::class)->only(['index','create','edit']);
    Route::resource('user',UserController::class)->only(['index','create','edit']);
    Route::resource('event',EventController::class)->only(['index','create','edit']);
    Route::resource('news',NewController::class)->only(['index','create','edit']);

});

