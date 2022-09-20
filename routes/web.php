<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;


Route::redirect('/', '/section');

/* section */
Route::get('/section', [SectionController::class, 'index'])->name('section.index');

/* topic */
Route::get('/topic/{id}/list', [TopicController::class, 'index'])->name('topic.list');
Route::resource('topic', TopicController::class);

/* message */
Route::get('/message/{id}/list', [MessageController::class, 'index'])->name('message.list');
Route::resource('message', MessageController::class);

/* user */
Route::post('/user/login', [UserController::class, 'login'])->name('user.login');
Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
Route::resource('user', UserController::class);

/* admin */
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/all_users', [App\Http\Controllers\Admin\UserController::class, 'showAll'])->name('admin.user.showAll');
    Route::get('/user/{id}/active', [App\Http\Controllers\Admin\UserController::class, 'active'])->name('admin.user.active');
    Route::get('/user/{id}/status', [\App\Http\Controllers\Admin\UserController::class, 'status'])->name('admin.user.status');
    Route::post('/section/store', [\App\Http\Controllers\Admin\SectionController::class, 'store'])->name('admin.user.store');
});
