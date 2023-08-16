<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\MatterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassRoomController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::controller(MatterController::class)->prefix('matters')->group(function(){
        Route::get('', 'index')->name('matters.index');
        Route::get('{action}/form', 'form')->name('matters.form');
        Route::post('', 'store')->name('matters.store');
        Route::put('{matter}/update', 'update')->name('matters.update');
        Route::delete('{matter}/delete', 'destroy')->name('matters.destroy');
    });
    Route::controller(ClassRoomController::class)->prefix('classes')->group(function(){
        Route::get('', 'index')->name('classes.index');
        Route::get('{slug}', 'show')->name('classes.show');
        Route::get('{action}/form', 'form')->name('classes.form');
        Route::post('', 'store')->name('classes.store');
        Route::put('{classe}/update', 'update')->name('classes.update');
        Route::delete('{classe}/delete', 'destroy')->name('classes.destroy');
    });
    Route::controller(TeacherController::class)->prefix('teachers')->group(function(){
        Route::get('', 'index')->name('teachers.index');
        Route::get('{action}/form', 'form')->name('teachers.form');
        Route::post('', 'store')->name('teachers.store');
        Route::put('{teacher}/update', 'update')->name('teachers.update');
        Route::get('{teacher}/change-status', 'status')->name('teachers.status');
        Route::get('{teacher}/create-class', 'createClass')->name('teachers.createClass');
        Route::post('{teacher}/classes', 'associateClass')->name('teachers.classes');
    });
    Route::controller(StudentController::class)->prefix('students')->group(function(){
        Route::get('', 'index')->name('students.index');
        Route::get('{action}/form', 'form')->name('students.form');
        Route::post('', 'store')->name('students.store');
        Route::put('{student}/update', 'update')->name('students.update');
        Route::get('{student}/change-status', 'status')->name('students.status');
        Route::get('{student}/create-class', 'createClass')->name('students.createClass');
        Route::post('{student}/classes', 'associateClass')->name('students.classes');
    });
    Route::controller(TutorController::class)->prefix('tutors')->group(function(){
        Route::get('', 'index')->name('tutors.index');
        Route::get('{action}/form', 'form')->name('tutors.form');
        Route::post('', 'store')->name('tutors.store');
        Route::put('{tutor}/update', 'update')->name('tutors.update');
        Route::get('{tutor}/change-status', 'status')->name('tutors.status');
        Route::get('{tutor}/create-student', 'createStudent')->name('tutors.createStudent');
        Route::post('{tutor}/students', 'associateStudent')->name('tutors.students');
    });
});

require __DIR__.'/auth.php';
