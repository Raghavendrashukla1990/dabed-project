<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseTestController;
use App\Http\Controllers\StudentFeesStatusController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\ScoreRecordController;
use App\Http\Controllers\GatepassController;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::controller(CourseController::class)->group(function () {
        Route::prefix('courses')->group(function () {
            Route::get('/index', 'index')->name('courses.index');
            Route::get('/create', 'create')->name('courses.create');
            Route::post('/store', 'store')->name('courses.store');
            Route::get('/edit/{id}', 'edit')->name('courses.edit')->whereNumber('id');
            Route::post('/update/{id}', 'update')->name('courses.update');
            Route::get('/delete/{id}', 'destroy')->name('courses.delete')->whereNumber('id');
        });
    });

    Route::controller(CourseTestController::class)->group(function () {
        Route::prefix('course-test')->group(function () {
            Route::get('/index', 'index')->name('course.test.index');
            Route::get('/create', 'create')->name('course.test.create');
            Route::post('/store', 'store')->name('course.test.store');
            Route::get('/edit/{id}', 'edit')->name('course.test.edit')->whereNumber('id');
            Route::post('/update/{id}', 'update')->name('course.test.update');
            Route::get('/delete/{id}', 'destroy')->name('course.test.delete')->whereNumber('id');;
        });
    });


    Route::controller(StudentRegistrationController::class)->group(function () {
        Route::prefix('student')->group(function () {
            Route::get('/index', 'index')->name('student.index');
            Route::get('/create', 'create')->name('student.create');
            Route::post('/store', 'store')->name('student.store');
            Route::get('/edit/{id}', 'edit')->name('student.edit')->whereNumber('id');
            Route::post('/update/{id}', 'update')->name('student.update');
            Route::get('/delete/{id}', 'destroy')->name('student.delete')->whereNumber('id');;
        });
    });

    Route::controller(StudentFeesStatusController::class)->group(function () {
        Route::prefix('student-fee')->group(function () {
            Route::get('/index', 'index')->name('student.fee.index');
            Route::get('/create', 'create')->name('student.fee.create');
            Route::post('/store', 'store')->name('student.fee.store');
            Route::get('/edit/{id}', 'edit')->name('student.fee.edit')->whereNumber('id');
            Route::post('/update/{id}', 'update')->name('student.fee.update');
            Route::get('/delete/{id}', 'destroy')->name('student.fee.delete')->whereNumber('id');;
        });
    });

    Route::controller(ScoreRecordController::class)->group(function () {
        Route::prefix('scored-record')->group(function (){
            Route::get('/index', 'index')->name('scored.record.index');
            Route::get('/create', 'create')->name('scored.record.create');
            Route::post('/store', 'store')->name('scored.record.store');
            Route::get('/edit/{id}', 'edit')->name('scored.record.edit')->whereNumber('id');
            Route::post('/update/{id}', 'update')->name('scored.record.update');
            Route::get('/delete/{id}', 'destroy')->name('scored.record.delete')->whereNumber('id');
        });
    });

    Route::controller(GatepassController::class)->group(function () {
        Route::prefix('gate-pass')->group(function (){
            Route::get('/index', 'index')->name('gate.pass.index');
            Route::get('/create', 'create')->name('gate.pass.create');
            Route::post('/store', 'store')->name('gate.pass.store');
            Route::get('/edit/{id}', 'edit')->name('gate.pass.edit')->whereNumber('id');
            Route::post('/update/{id}', 'update')->name('gate.pass.update');
            Route::get('/delete/{id}', 'destroy')->name('gate.pass.delete')->whereNumber('id');
        });
    });
});
