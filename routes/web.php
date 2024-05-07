<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

// Route for the welcome page
Route::get('/', [WelcomeController::class, 'welcome'])->middleware('guest');

// Route for the user login and register page
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Route for storing user information in the database
Route::post('/users', [UserController::class, 'store'])->middleware('guest');

// Route for logging out the user
Route::post('/logout', [UserController::class, 'logout'])->middleware(['auth', 'verified']);

Route::get('/profile', [UserController::class, 'edit'])->middleware(['auth', 'verified']);

Route::put('/profile', [UserController::class, 'update'])->middleware(['auth', 'verified']);

// Route for authenticating the user
Route::post('/users/authenticate', [UserController::class, 'authentication']);

// Route for the email verification notice page, which is accessible only to authenticated users
Route::get('/email/verify', [EmailController::class, 'verify_email'])->middleware('auth')->name('verification.notice');

// Route for handling the email verification, which is accessible only to authenticated and signed users
Route::get('/email/verify/{id}/{hash}', [EmailController::class, 'handel_email_verification'])->middleware(['auth', 'signed'])->name('verification.verify');

// Route for the main page, which is accessible only to authenticated and verified users
Route::get('/home', [GroupController::class, 'index'])->middleware(['auth', 'verified']);

Route::post('/group/creat', [GroupController::class, 'store'])->middleware(['auth', 'verified']);

Route::post('/group/join', [GroupController::class, 'join'])->middleware(['auth', 'verified']);

Route::get('/group/{group}', [GroupController::class, 'show'])->middleware(['auth', 'verified', 'member'])->name('group');

Route::post('/group/{group}/leave', [GroupController::class, 'leave'])->middleware(['auth', 'verified', 'member']);

Route::get('/group/{group}/modify', [GroupController::class, 'edit'])->middleware(['auth', 'verified', 'member', 'leader']);

Route::put('/group/{group}/modify', [GroupController::class, 'update'])->middleware(['auth', 'verified', 'member', 'leader']);

Route::get('/group/{group}/invitations', [InvitationController::class, 'index'])->middleware(['auth', 'verified', 'member', 'leader'])->name('group-invi');

Route::post('/group/{group}/invitations/{user}', [InvitationController::class, 'response'])->middleware(['auth', 'verified', 'member', 'leader']);

Route::get('/group/{group}/documents', [DocumentController::class, 'index'])->middleware(['auth', 'verified', 'member']);

Route::post('/group/{group}/documents', [DocumentController::class, 'store'])->middleware(['auth', 'verified', 'member']);

Route::delete('/group/{group}/documents/{document}', [DocumentController::class, 'delete'])->middleware(['auth', 'verified', 'member']);

Route::get('group/{group}/document/{document}', [DocumentController::class, 'show'])->middleware(['auth', 'verified', 'member']);

Route::get('/group/{group}/projects', [FileController::class, 'index'])->middleware(['auth', 'verified', 'member']);

Route::get('/group/{group}/projects/{file}', [FileController::class, 'show'])->middleware(['auth', 'verified', 'member']);

Route::delete('/group/{group}/projects/{file}', [FileController::class, 'delete'])->middleware(['auth', 'verified', 'member', 'leader']);

Route::get('/group/{group}/projects/{file}/{version}', [FileController::class, 'show_version'])->middleware(['auth', 'verified', 'member']);

Route::post('/group/{group}/projects', [FileController::class, 'store'])->middleware(['auth', 'verified', 'member', 'leader']);

Route::get('/group/{group}/kick_out/{user}', [GroupController::class, 'kick_out'])->middleware(['auth', 'verified', 'leader']);

Route::get('/group/{group}/task', [TaskController::class, 'index'])->middleware(['auth', 'verified', 'member']);

Route::get('/group/{group}/task/create', [TaskController::class, 'create'])->middleware(['auth', 'verified', 'member', 'leader']);

Route::post('/group/{group}/task', [TaskController::class, 'store'])->middleware(['auth', 'verified', 'member', 'leader']);

Route::get('/group/{group}/task/{task}', [TaskController::class, 'show'])->middleware(['auth', 'verified', 'member']);

Route::delete('/group', [GroupController::class, 'delete'])->middleware(['auth', 'verified', 'leader']);
