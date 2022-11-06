<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\SubmitExerciseController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store']);

Route::get('/', [UserController::class, 'index'])->middleware('auth');
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('{user}/show', [UserController::class, 'show'])->name('user.show');
    Route::post('{user}/info', [UserController::class, 'updateInfo'])->name('user.info');
    Route::get('create', [UserController::class, 'create'])->name('user.create');
    Route::post('store', [UserController::class, 'store'])->name('user.store');
    Route::get('{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('{user}/update', [UserController::class, 'updateInfo'])->name('user.update');
    Route::get('{user}/delete', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::group(['prefix' => 'role', 'middleware' => 'auth'], function () {
    Route::get('/', [RoleController::class, 'index'])->name('role.index')->middleware('check.permission:view_role');
    Route::get('create', [RoleController::class, 'create'])->name('role.create')->middleware('check.permission:add_role');
    Route::post('store', [RoleController::class, 'store'])->name('role.store')->middleware('check.permission:add_role');
    Route::get('{role}/edit', [RoleController::class, 'edit'])->name('role.edit')->middleware('check.permission:edit_role');
    Route::post('{role}/update', [RoleController::class, 'update'])->name('role.update')->middleware('check.permission:edit_role');
    Route::get('{role}/delete', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('check.permission:delete_role');
});

Route::group(['prefix' => 'messenger', 'middleware' => 'auth'], function () {
    Route::get('{user}/create', [MessengerController::class, 'create'])->name('messenger.create');
    $messengerUser = Route::post('store{user?}/{mess?}/{from?}', [
        'as' => 'messenger.store',
        'uses' => 'App\Http\Controllers\MessengerController@store',
    ]);
    $messengerUser->defaults = ['user' => request()->route('user'), 'mess' => 0];
    Route::get('{mess}/edit', [MessengerController::class, 'edit'])->name('messenger.edit');
    Route::post('{mess}/update', [MessengerController::class, 'update'])->name('messenger.update');
    Route::get('{mess}/delete', [MessengerController::class, 'delete'])->name('messenger.delete');
    Route::get('notify', [MessengerController::class, 'notify'])->name('messenger.notify');
});

Route::group(['prefix' => 'exercise', 'middleware' => 'auth'], function () {
    Route::get('create', [ExerciseController::class, 'create'])->name('exercise.create');
    Route::post('store', [ExerciseController::class, 'store'])->name('exercise.store');
    Route::get('{id}/show', [ExerciseController::class, 'show'])->name('exercise.show');
    Route::get('{id}/edit', [ExerciseController::class, 'edit'])->name('exercise.edit');
    Route::post('{id}/update', [ExerciseController::class, 'update'])->name('exercise.update');
    Route::get('{id}/delete', [ExerciseController::class, 'destroy'])->name('exercise.destroy');
});

Route::group(['prefix' => 'submit', 'middleware' => 'auth'], function () {
    Route::get('{exercise}/create', [SubmitExerciseController::class, 'create'])->name('submit.create');
    Route::post('{exercise}/store', [SubmitExerciseController::class, 'store'])->name('submit.store');
    Route::get('{id}/edit', [SubmitExerciseController::class, 'edit'])->name('submit.edit');
    Route::post('{id}/update', [SubmitExerciseController::class, 'update'])->name('submit.update');
    Route::get('{id}/delete', [SubmitExerciseController::class, 'destroy'])->name('submit.destroy');
});

Route::group(['prefix' => 'game', 'middleware' => 'auth'], function () {
    Route::get('create', [GameController::class, 'create'])->name('game.create');
    Route::post('store', [GameController::class, 'store'])->name('game.store');
    Route::get('{id}/show', [GameController::class, 'show'])->name('game.show');
    Route::post('{id}/update', [GameController::class, 'update'])->name('game.update');
    Route::post('{id}/play', [GameController::class, 'play'])->name('game.play');
    Route::get('{id}/delete', [GameController::class, 'destroy'])->name('game.destroy');
});

Route::resource('register', RegisterController::class)->only('index', 'store');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('db', function() {
    Artisan::call('migrate');
});

Route::get('db/seed', function() {
    Artisan::call('db:seed --class=UserSeeder');
});