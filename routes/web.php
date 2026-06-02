<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\JournalController;

// Публичные маршруты (доступны всем)
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/login', [PostController::class, 'login']);
Route::post('/logout', [PostController::class, 'logout'])->name('logout');

// Единый распределитель (отправляет админа в админку, а учителя в журнал)
Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');

// Маршруты только для Администратора (управление статьями)
Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/admin/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

// Маршруты только для Учителя (электронный журнал)
Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
Route::post('/journal/setup', [JournalController::class, 'setupClass'])->name('journal.setup');
Route::post('/journal/grades', [JournalController::class, 'saveGrades'])->name('journal.grades.save');
// Маршрут барои скачат кардани PDF-и баҳоҳо
Route::get('/journal/export-pdf', [JournalController::class, 'exportPdf'])->name('journal.pdf');