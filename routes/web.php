<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;


//Homepage
Route::get('/',[TaskController::class, 'Homepage']);
Route::get('/getTasks',[TaskController::class, 'searchTasks'])->name('searchTasks');

//Tasks Route
Route::get('/create-task',[TaskController::class, 'index'])->name('create-task');
Route::post('/create-task',[TaskController::class, 'create'])->name('store-task');
Route::get('/view-task/{id}',[TaskController::class, 'show'])->name('view-task');
Route::put('/view-task/{id}',[TaskController::class, 'updatePost'])->name('update-post');

//Profile
Route::get('/profile',[ProfileController::class, 'myprofile'])->name('profile-view');

//Extras
// Route::resource('tasks', HomeController::class);
Route::get('/all-tasks',[HomeController::class, 'viewTasks'])->name('view-Tasks');
Route::delete('/all-tasks/{id}',[HomeController::class, 'destroy'])->name('delete-Tasks');
Route::get('/all-users',[HomeController::class, 'viewUsers'])->name('view-Users');
Route::delete('/all-users/{id}',[HomeController::class, 'destroyUser'])->name('delete-Users');
Route::put('/update-user/{id}', [HomeController::class, 'updateUserData'])->name('update-user');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
