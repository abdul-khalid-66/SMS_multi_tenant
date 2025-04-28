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
    SubjectController,
    SchoolProfileController,
};
use App\Http\Controllers\Timetable\{
    TimetableController
};

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return view('App.welcome');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');

    // Parent
    Route::get('/parents', [ParentController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.parents');
    Route::post('/add_parent', [ParentController::class, 'Store'])->middleware(['auth', 'verified'])->name('admin.store.parent');
    Route::get('/add_parent', [ParentController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.add.parent');
    Route::get('/edit_parent', [ParentController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.edit.parent');
    Route::post('/edit_parent', [ParentController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.update.parent');
    Route::get('/destroy_parent/{encryptedId}', [ParentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.destroy.parent');

    // Student
    Route::get('/students', [StudentController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.students');
    Route::get('/add_student', [StudentController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.add.student');
    Route::post('/add_student', [StudentController::class, 'store'])->middleware(['auth', 'verified'])->name('admin.store.student');
    Route::get('/edit_student', [StudentController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.edit.student');
    Route::post('/edit_student', [StudentController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.update.student');
    Route::delete('/destroy_student', [StudentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.destroy.student');
    Route::get('/get-sections/{classId}', [StudentController::class, 'getSections'])->middleware(['auth', 'verified']);

    // Teacher
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
    Route::get('/get-sections/{class_id}', [SectionController::class, 'getSectionsByClass']);

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
    Route::post('subject_assign/', [SubjectController::class, 'assignTeacherStore'])->name('admin.academic.subjects.assign_teacher');

    Route::middleware(['auth', 'verified'])->group(function () {
        // School Profile Routes
        Route::get('/school', [SchoolProfileController::class, 'index'])->name('schools.show');
        Route::get('/schools/edit', [SchoolProfileController::class, 'edit'])->name('schools.edit');
        Route::put('/schools', [SchoolProfileController::class, 'update'])->name('schools.update');

        // School Settings Routes
        Route::prefix('schools/settings')->group(function () {
            Route::get('/', [SchoolProfileController::class, 'showSettings'])->name('schools.settings');
            Route::put('/', [SchoolProfileController::class, 'updateSettings'])->name('schools.update-settings');
            Route::put('/academic', [SchoolProfileController::class, 'updateAcademicSettings'])->name('schools.update-academic-settings');
            Route::put('/attendance', [SchoolProfileController::class, 'updateAttendanceSettings'])->name('schools.update-attendance-settings');
        });
    });

    // User Profile
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::resource('user', UserController::class);
    });

    // Timetable
    Route::prefix('timetable')->middleware(['auth', 'verified'])->name('admin.timetable.')->group(function () {
        Route::get('/', [TimetableController::class, 'index'])->name('index');
        Route::get('/create', [TimetableController::class, 'create'])->name('create');
        Route::post('/', [TimetableController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TimetableController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TimetableController::class, 'update'])->name('update');
        Route::delete('/{id}', [TimetableController::class, 'destroy'])->name('destroy');
    });
    Route::get('create_schedule', [TimetableController::class, 'create_schedule'])->name('admin.timetable.create.schedule');
    Route::post('store_schedule', [TimetableController::class, 'store_schedule'])->name('admin.timetable.store.schedule');

    require __DIR__ . '/tenant-auth.php';
});
