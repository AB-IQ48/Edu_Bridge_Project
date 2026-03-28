<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterCompanyController;
use App\Http\Controllers\Auth\RegisterStudentController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CounsellorController;
use App\Http\Controllers\CounsellorListingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDocumentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
});

// Public info pages (header tabs)
Route::get('/how-it-works', fn () => view('pages.how-it-works'))->name('pages.how-it-works');
Route::get('/verification', fn () => view('pages.verification'))->name('pages.verification');
Route::get('/visa-readiness', fn () => view('pages.visa-readiness'))->name('pages.visa-readiness');
Route::get('/for-you', fn () => view('pages.for-you'))->name('pages.for-you');
Route::get('/faq', fn () => view('pages.faq'))->name('pages.faq');

// Verified counsellors listing & public profiles. Students attach via POST (auth required).
Route::get('/counsellors', [CounsellorListingController::class, 'index'])->name('counsellors.index');
Route::get('/counsellors/{counsellorProfile}', [CounsellorListingController::class, 'show'])->name('counsellors.show');
Route::post('/counsellors/detach', [CounsellorListingController::class, 'detach'])->middleware('auth')->name('counsellors.detach');
Route::post('/counsellors/{counsellorProfile}/attach', [CounsellorListingController::class, 'attach'])->middleware('auth')->name('counsellors.attach');

// Guest: login and registration
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');

    Route::get('/register/student', [RegisterStudentController::class, 'create'])->name('register.student');
    Route::post('/register/student', [RegisterStudentController::class, 'store'])->name('register.student.store');

    Route::get('/register/company', [RegisterCompanyController::class, 'create'])->name('register.company');
    Route::post('/register/company', [RegisterCompanyController::class, 'store'])->name('register.company.store');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Authenticated: general dashboard
Route::get('/dashboard', DashboardController::class)
    ->middleware('auth')
    ->name('dashboard');

// Administrator: dashboard, counsellors, documents
Route::middleware(['auth', 'role:administrator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/counsellors', [AdminController::class, 'counsellorsIndex'])->name('counsellors.index');
    Route::get('/counsellors/{counsellorProfile}', [AdminController::class, 'counsellorShow'])->name('counsellors.show');
    Route::get('/documents', [AdminController::class, 'documentsIndex'])->name('documents.index');
    Route::post('/profiles/{counsellorProfile}/review', [AdminController::class, 'reviewProfile'])->name('profiles.review');
    Route::post('/documents/{document}/review', [AdminController::class, 'reviewDocument'])->name('documents.review');
});

// Counsellor: profile and documents
Route::middleware(['auth', 'role:counsellor'])->prefix('counsellor')->name('counsellor.')->group(function () {
    Route::get('/', [CounsellorController::class, 'index'])->name('index');
    Route::get('/profile/edit', [CounsellorController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [CounsellorController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:counsellor'])->resource('documents', DocumentController::class)->except(['edit', 'update']);

// Student: profile, documents, and visa scores
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::get('/documents', [StudentDocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [StudentDocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [StudentDocumentController::class, 'store'])->name('documents.store');
});

Route::middleware(['auth', 'role:student'])->prefix('scores')->name('scores.')->group(function () {
    Route::get('/', [ScoreController::class, 'index'])->name('index');
    Route::get('/assess', [ScoreController::class, 'assess'])->name('assess');
    Route::post('/assess', [ScoreController::class, 'storeFromQuestionnaire'])->name('assess.store');
    Route::get('/{score}', [ScoreController::class, 'show'])->name('show');
});

// Student-Counsellor chat (role restricted)
Route::middleware(['auth', 'role:student,counsellor'])->prefix('chat')->name('chat.')->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('index');
    Route::get('/{user}', [ChatController::class, 'index'])->name('show');
    Route::post('/{user}', [ChatController::class, 'store'])->name('store');
});
