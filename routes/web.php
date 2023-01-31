<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
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
    return redirect('/courses');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/courses', CourseController::class)->names('courses');
    Route::resource('/subjects', SubjectController::class)->names('subjects');
    Route::resource('/admins', AdminController::class)->names('admins');
    Route::resource('/teachers', TeacherController::class)->names('teachers');
    Route::resource('/students', StudentController::class)->names('students');
    Route::resource('/settings', SettingsController::class)->only('index', 'update')->names('settings');
    Route::resource('/payments', PaymentController::class)->names('payments');

    Route::get('/students/{student}/info', [StudentController::class, 'info']);
    Route::post('/students/calification', [CourseController::class, 'setCalification']);
    Route::post('/courses/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::delete('/courses/unsuscribe/{id}', [CourseController::class, 'unsuscribe'])->name('courses.unsuscribe');
    Route::post('/payments/paypending', [PaymentController::class, 'payPending'])->name('payments.pay-pending');


});




// Route::GET('/courses', [CourseController::class, 'index'])->name('courses.index')->middleware(['role:teacher']);
// Route::POST('/courses', [CourseController::class, 'store'])->name('courses.store')->middleware(['role:admin','role:teacher']);
// Route::GET('/courses/create', [CourseController::class, 'create'])->name('courses.create')->middleware(['role:admin','role:teacher']);
// Route::GET('/courses/{course}', [CourseController::class, 'show'])->name('courses.show')->middleware(['role:admin','role:teacher']);
// Route::PUT('/courses/{course}', [CourseController::class, 'update'])->name('courses.update')->middleware(['role:admin','role:teacher']);
// Route::DELETE('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy')->middleware(['role:admin','role:teacher']);
// Route::GET('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit')->middleware(['role:admin','role:teacher']);
// Route::GET('/subjects', [SubjectController::class, 'index'])->name('subjects.index')->middleware(['role:admin']);
// Route::POST('/subjects', [SubjectController::class, 'store'])->name('subjects.store')->middleware(['role:admin']);
// Route::GET('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create')->middleware(['role:admin']);
// Route::GET('/subjects/{subject}', [SubjectController::class, 'show'])->name('subjects.show')->middleware(['role:admin']);
// Route::PUT('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update')->middleware(['role:admin']);
// Route::DELETE('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy')->middleware(['role:admin']);
// Route::GET('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit')->middleware(['role:admin']);
// Route::GET('/admins', [AdminController::class, 'index'])->name('admins.index')->middleware(['role:admin']);
// Route::POST('/admins', [AdminController::class, 'store'])->name('admins.store')->middleware(['role:admin']);
// Route::GET('/admins/create', [AdminController::class, 'create'])->name('admins.create')->middleware(['role:admin']);
// Route::GET('/admins/{admin}', [AdminController::class, 'show'])->name('admins.show')->middleware(['role:admin']);
// Route::PUT('/admins/{admin}', [AdminController::class, 'update'])->name('admins.update')->middleware(['role:admin']);
// Route::DELETE('/admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy')->middleware(['role:admin']);
// Route::GET('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit')->middleware(['role:admin']);
// Route::GET('/teachers', [TeacherController::class, 'index'])->name('teachers.index')->middleware(['role:admin']);
// Route::POST('/teachers', [TeacherController::class, 'store'])->name('teachers.store')->middleware(['role:admin']);
// Route::GET('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create')->middleware(['role:admin']);
// Route::GET('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show')->middleware(['role:admin']);
// Route::PUT('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update')->middleware(['role:admin']);
// Route::DELETE('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy')->middleware(['role:admin']);
// Route::GET('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit')->middleware(['role:admin']);
// Route::GET('/students', [StudentController::class, 'index'])->name('students.index')->middleware(['role:admin']);
// Route::POST('/students', [StudentController::class, 'store'])->name('students.store')->middleware(['role:admin']);
// Route::GET('/students/create', [StudentController::class, 'create'])->name('students.create')->middleware(['role:admin']);
// Route::GET('/students/{student}', [StudentController::class, 'show'])->name('students.show')->middleware(['role:admin']);
// Route::PUT('/students/{student}', [StudentController::class, 'update'])->name('students.update')->middleware(['role:admin']);
// Route::DELETE('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy')->middleware(['role:admin']);
// Route::GET('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit')->middleware(['role:admin']);
// Route::GET('/settings', [SettingsController::class, 'index'])->name('settings.index')->middleware(['role:admin']);
// Route::PUT('/settings/{setting}', [SettingsController::class, 'update'])->name('settings.update')->middleware(['role:admin']);
// Route::GET('/payments', [PaymentController::class, 'index'])->name('payments.index')->middleware(['role:admin']);
// Route::POST('/payments', [PaymentController::class, 'store'])->name('payments.store')->middleware(['role:admin']);
// Route::GET('/payments/create', [PaymentController::class, 'create'])->name('payments.create')->middleware(['role:admin']);
// Route::GET('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show')->middleware(['role:admin']);
// Route::PUT('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update')->middleware(['role:admin']);
// Route::DELETE('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy')->middleware(['role:admin']);
// Route::GET('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit')->middleware(['role:admin']);
// Route::resource('/courses', CourseController::class)->names('courses')->middleware(['role:admin']);
// Route::resource('/subjects', SubjectController::class)->names('subjects')->middleware(['role:admin']);
// Route::resource('/admins', AdminController::class)->names('admins')->middleware(['role:admin']);
// Route::resource('/teachers', TeacherController::class)->names('teachers')->middleware(['role:admin']);
// Route::resource('/students', StudentController::class)->names('students')->middleware(['role:admin']);
// Route::resource('/settings', SettingsController::class)->only('index', 'update')->names('settings')->middleware(['role:admin']);
// Route::resource('/payments', PaymentController::class)->names('payments')->middleware(['role:admin']);
// Route::get('/students/{student}/info', [StudentController::class, 'info'])->middleware(['role:admin']);
// Route::post('/students/calification', [CourseController::class, 'setCalification'])->middleware(['role:admin']);
// Route::post('/courses/enroll', [CourseController::class, 'enroll'])->name('courses.enroll')->middleware(['role:admin']);
// Route::delete('/courses/unsuscribe/{id}', [CourseController::class, 'unsuscribe'])->name('courses.unsuscribe')->middleware(['role:admin']);
// Route::post('/payments/paypending', [PaymentController::class, 'payPending'])->name('payments.pay-pending')->middleware(['role:admin']);
