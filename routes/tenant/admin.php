<?php

declare(strict_types=1);

use App\Http\Controllers\App\{
    ProfileController,
    UserController
};
use App\Http\Controllers\Admin\{
    DashboardController,
    TeacherController,
    StudentController,
    ParentController,
    ClassesController,
    SectionController,
    SubjectController
};

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return view('App.welcome');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/parents', [ParentController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.parents');
    Route::post('/add_parent', [ParentController::class, 'Store'])->middleware(['auth', 'verified'])->name('admin.store.parent');
    Route::get('/add_parent', [ParentController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.add.parent');
    Route::get('/edit_parent', [ParentController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.edit.parent');
    Route::post('/edit_parent', [ParentController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.update.parent');
    // Route::delete('/destroy_parent/{id}', [ParentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.destroy.parent');
    Route::get('/destroy_parent/{encryptedId}', [ParentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.destroy.parent');

    Route::get('/students', [StudentController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.students');
    Route::get('/add_student', [StudentController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.add.student');
    Route::post('/add_student', [StudentController::class, 'store'])->middleware(['auth', 'verified'])->name('admin.store.student');
    Route::get('/edit_student', [StudentController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.edit.student');
    Route::post('/edit_student', [StudentController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.update.student');
    Route::delete('/destroy_student', [StudentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.destroy.student');
    Route::get('/get-sections/{classId}', [StudentController::class, 'getSections'])->middleware(['auth', 'verified']);


    Route::get('/teachers', [TeacherController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.teachers');
    Route::get('/add_teacher', [TeacherController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.add.teacher');
    Route::post('/add_teacher', [TeacherController::class, 'store'])->middleware(['auth', 'verified'])->name('admin.store.teacher');
    Route::get('/edit_teacher', [TeacherController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.edit.teacher');
    Route::post('/edit_teacher', [TeacherController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.update.teacher');
    Route::delete('/destroy_teacher', [TeacherController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.destroy.teacher');


    // Class Routes
    Route::prefix('classes')->middleware(['auth', 'verified'])->name('admin.academic.classes.')->group(function () {
        Route::get('/', [ClassesController::class, 'index'])->name('index');
        Route::get('/create', [ClassesController::class, 'create'])->name('create');
        Route::post('/', [ClassesController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ClassesController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ClassesController::class, 'update'])->name('update');
        Route::delete('/{id}', [ClassesController::class, 'destroy'])->name('destroy'); // <-- DELETE route
    });

    // Section Routes
    Route::prefix('sections')->middleware(['auth', 'verified'])->name('admin.academic.sections.')->group(function () {
        Route::get('/', [SectionController::class, 'index'])->name('index');
        Route::get('/create', [SectionController::class, 'create'])->name('create');
        Route::post('/', [SectionController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SectionController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SectionController::class, 'update'])->name('update');
        Route::delete('/{id}', [SectionController::class, 'destroy'])->name('destroy');
    });

    // Subject Routes
    Route::prefix('subjects')->middleware(['auth', 'verified'])->name('admin.academic.subjects.')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('index');
        Route::get('/create', [SubjectController::class, 'create'])->name('create');
        Route::post('/', [SubjectController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SubjectController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SubjectController::class, 'update'])->name('update');
        Route::delete('/{id}', [SubjectController::class, 'destroy'])->name('destroy');
    });
    Route::get('subject_assign/', [SubjectController::class, 'assign'])->name('admin.academic.subjects.assign');

    // Subject Teacher Assignment
    // Route::get('academic/subjects', [SubjectController::class, 'assignTeacher'])->name('admin.academic.subjects.assign');
    // Route::put('academic/subjects/{subject}/assign-teacher', [SubjectController::class, 'assignTeacherStore'])->name('admin.academic.subjects.assign-teacher');
    // // For AJAX section loading
    // Route::get('academic/sections/by-class', [SectionController::class, 'getSectionsByClass'])->name('admin.academic.sections.by-class');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::resource('user', UserController::class);
    });

    require __DIR__ . '/tenant-auth.php';
});
