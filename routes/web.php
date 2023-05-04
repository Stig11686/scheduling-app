<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CohortController;
use App\Http\Controllers\FunderController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\InstanceController;
use App\Http\Controllers\InstanceSessionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::resource('courses', CourseController::class, ['names' => [
        'index' => 'courses'
    ]]);
    Route::resource('cohorts', CohortController::class, ['names' => [
        'index' => 'cohorts'
    ]]);
    Route::resource('funders', FunderController::class, ['names' => [
        'index' => 'funders'
    ]]);
    Route::resource('sessions', SessionController::class, ['names' => [
        'index' => 'sessions'
    ]]);
    Route::resource('currentcourses', InstanceController::class, ['names' => [
        'index' => 'currentcourses'
    ]]);
    Route::resource('edit-session', InstanceSessionController::class, ['names' => [
        'index' => 'edit-session'
    ]]);
    Route::resource('users', UserController::class, ['names' => [
        'index' => 'users'
    ]]);
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


