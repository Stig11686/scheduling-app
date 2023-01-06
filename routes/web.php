<?php

use App\Http\Controllers\CohortController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FunderController;
use App\Http\Controllers\InstanceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\ZoomRoomController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use App\Models\Funder;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Spatie\GoogleCalendar\Event;

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

Route::get('/', function () {
    return view('welcome');
})->Middleware('auth');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('courses', CourseController::class, ['names' => [
        'index' => 'courses'
    ]]);
    Route::resource('cohorts', CohortController::class, ['names' => [
        'index' => 'cohorts'
    ]]);
    Route::resource('funders', FunderController::class, ['names' => [
        'index' => 'funders'
    ]]);

    Route::resource('currentcourses', InstanceController::class, ['names' => [
        'index' => 'instances'
    ]]);
    Route::resource('sessions', SessionController::class, ['names' => [
        'index' => 'sessions'
    ]]);
    Route::resource('trainers', TrainerController::class, ['names' => [
        'index' => 'trainers'
    ]]);
    Route::resource('users', UserController::class, ['names' => [
        'index' => 'users'
    ]]);
    Route::resource('zoomRoom', ZoomRoomController::class, ['names' => [
        'index' => 'zoomRooms'
    ]]);
});

Route::get('/dashboard', [CourseController::class, 'index'])->name('dashboard');

Route::get('/trainers/{id}', [TrainerController::class, 'show']);

Route::get('/calendar', function(){
    $e = new Event;

    $e->name = 'Test from app';
    $e->startDateTime = Carbon\Carbon::now();
    $e->endDateTime = Carbon\Carbon::now()->addHour();

    $e->save();

    dd($e);
});

// Route::post('/currentcourses/{id}', [InstanceController::class, 'show']);


require __DIR__.'/auth.php';
