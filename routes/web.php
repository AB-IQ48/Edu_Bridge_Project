<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterCompanyController;
use App\Http\Controllers\Auth\RegisterStudentController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CounsellorController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\CounsellorListingController;
use App\Http\Controllers\CounsellorNotificationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\CounsellorStudentDocumentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->name('home');

// Public complaint submission (no login required)
Route::post('/complaints/public', [\App\Http\Controllers\PublicComplaintController::class, 'store'])
    ->middleware('throttle:10,60')
    ->name('complaints.public.store');

// Public info pages (header tabs)
Route::get('/how-it-works', fn () => view('pages.how-it-works'))->name('pages.how-it-works');
Route::get('/verification', fn () => view('pages.verification'))->name('pages.verification');
Route::get('/visa-readiness', fn () => view('pages.visa-readiness'))->name('pages.visa-readiness');
Route::get('/for-you', fn () => view('pages.for-you'))->name('pages.for-you');
Route::get('/faq', fn () => view('pages.faq'))->name('pages.faq');
Route::get('/about', fn () => view('pages.about'))->name('pages.about');
Route::get('/research', fn () => view('pages.research'))->name('pages.research');
Route::get('/contact', fn () => view('pages.contact'))->name('pages.contact');
Route::get('/privacy', fn () => view('pages.privacy'))->name('pages.privacy');
Route::get('/terms', fn () => view('pages.terms'))->name('pages.terms');
Route::get('/data-security', fn () => view('pages.data-security'))->name('pages.data-security');
Route::get('/complaints', fn () => view('pages.complaints'))->name('pages.complaints');

// Verified counsellors listing & public profiles. Students attach via POST (auth required).
Route::get('/counsellors', [CounsellorListingController::class, 'index'])->name('counsellors.index');
Route::get('/counsellors/{counsellorProfile}', [CounsellorListingController::class, 'show'])->name('counsellors.show');
Route::post('/counsellors/detach', [CounsellorListingController::class, 'detach'])->middleware('auth')->name('counsellors.detach');
Route::post('/counsellors/{counsellorProfile}/attach', [CounsellorListingController::class, 'attach'])->middleware('auth')->name('counsellors.attach');

// Guest: login and registration
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])
        ->middleware('throttle:8,1')
        ->name('login.store');

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
    Route::get('/documents/{document}/file', [AdminController::class, 'downloadCounsellorDocument'])->name('documents.file');
    Route::get('/students', [AdminController::class, 'studentsIndex'])->name('students.index');
    Route::get('/visa-scores', [AdminController::class, 'scoresIndex'])->name('scores.index');
    Route::post('/profiles/{counsellorProfile}/review', [AdminController::class, 'reviewProfile'])->name('profiles.review');
    Route::post('/documents/{document}/review', [AdminController::class, 'reviewDocument'])->name('documents.review');
    Route::get('/complaints', [AdminComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/{complaint}', [AdminComplaintController::class, 'show'])->name('complaints.show');
    Route::post('/complaints/{complaint}', [AdminComplaintController::class, 'update'])->name('complaints.update');
});

// Counsellor: profile and documents
Route::middleware(['auth', 'role:counsellor'])->prefix('counsellor')->name('counsellor.')->group(function () {
    Route::get('/', [CounsellorController::class, 'index'])->name('index');
    Route::get('/profile/edit', [CounsellorController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [CounsellorController::class, 'update'])->name('profile.update');
    Route::get('/notifications', [CounsellorNotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}/open', [CounsellorNotificationController::class, 'open'])
        ->whereUuid('id')
        ->name('notifications.open');
    Route::post('/notifications/read-all', [CounsellorNotificationController::class, 'readAll'])->name('notifications.read-all');
    Route::get('/complaints', [ComplaintController::class, 'index'])->defaults('panel', 'counsellor')->name('complaints.index');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->defaults('panel', 'counsellor')->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])
        ->middleware('throttle:10,60')
        ->defaults('panel', 'counsellor')
        ->name('complaints.store');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->defaults('panel', 'counsellor')->name('complaints.show');

    // Student documents (assigned students only)
    Route::get('/assigned-students/{student}/documents', [CounsellorStudentDocumentController::class, 'index'])
        ->name('assigned-students.documents');
    Route::get('/student-documents/{studentDocument}/download', [CounsellorStudentDocumentController::class, 'download'])
        ->name('student-documents.download');
});

Route::middleware(['auth', 'role:counsellor'])->resource('documents', DocumentController::class)->only(['index', 'create', 'store', 'show']);

// Student: profile, documents, and visa scores
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::get('/documents', [StudentDocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [StudentDocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [StudentDocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/download', [StudentDocumentController::class, 'download'])->name('documents.download');
    Route::get('/complaints', [ComplaintController::class, 'index'])->defaults('panel', 'student')->name('complaints.index');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->defaults('panel', 'student')->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])
        ->middleware('throttle:10,60')
        ->defaults('panel', 'student')
        ->name('complaints.store');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->defaults('panel', 'student')->name('complaints.show');
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
