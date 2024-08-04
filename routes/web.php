<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\PostTestController;
use App\Http\Controllers\PusherAuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TugasProgressController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('index');
// });
// Route::get('/modul', function () {
//     return view('modul');
// })->name('modul');
// Route::get('/modul/materi', function () {
//     return view('materi');
// })->name('materi');
// Route::get('/modul/post-test', function () {
//     return view('post-test');
// })->name('post-test');

Route::middleware('guest')->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Register Routes
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [ModulController::class, 'index'])->name('home');
    Route::get('/moduls/{category}', [ModulController::class, 'getModulsByCategory']);
    Route::get('/modul/{id}', [ModulController::class, 'showModul'])->name('modul');
    Route::get('/materi/{id}', [ModulController::class, 'showMateri'])->name('materi');
    Route::get('/post-test/{modulId}', [PostTestController::class, 'show'])->name('post-test');
    Route::post('/post-test/{modulId}', [PostTestController::class, 'store'])->name('post-test.store');
    Route::get('/post-test/{modulId}/answer', [PostTestController::class, 'answer'])->name('post-test.answer');
    Route::get('/task/{id}', [ModulController::class, 'showTask'])->name('task');
    Route::get('/tugas-progress/get/{taskId}', [ModulController::class, 'getTaskProgress'])->name('tugas-progress.get');
    Route::post('/tugas-progress/store/{taskId}', [TugasProgressController::class, 'store'])->name('tugas-progress.store');
    // web.php
    Route::delete('/tugas-progress/delete-file/{taskId}', [TugasProgressController::class, 'deleteFile'])->name('tugas-progress.deleteFile');

    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send.message');
    Route::get('/fetch-messages/{dosen_id}', [ChatController::class, 'fetchMessages'])->name('fetch.messages');
    Route::post('/pusher/auth', [PusherAuthController::class, 'authenticate']);
});




Route::get('/profile', function () {
    return view('post-test');
})->name('profile');
Route::get('/modul/materi/latihan', function () {
    return view('latihan');
})->name('latihan');


Route::get('/review/{userId}', [ReviewController::class, 'index'])->name('saling-review');
Route::get('/review/detail-options/{progress_id}', [ReviewController::class, 'detailOptions'])->name('detail-review-option');
Route::get('/convert-ppt-to-pdf/{id}', [ReviewController::class, 'convertPptToPdf']);



Route::get('/review/detail', function () {
    return view('saling-review.detail');
})->name('detail-review');
