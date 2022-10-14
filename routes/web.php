<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/subjects', function () {
        return view('subjects');
    })->name('subjects');

    Route::get('/teachers', function () {
        return view('teachers.index');
    })->name('teachers');

    Route::get('/students', function () {
        return view('students');
    })->name('students');

    Route::resource('/courses', CourseController::class)->names('courses')->names('courses');

});
