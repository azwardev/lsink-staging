<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;

use App\Http\Controllers\permohonan\PelepasanEflueanController;
use App\Http\Controllers\payment\PaymentController;
use App\Http\Controllers\AdminController;

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

// Main Page Route

  // authentication
  Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
  Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');



  Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function(){

  Route::get('/', [HomePage::class, 'index'])->name('pages-home');
  Route::get('/permohonan/pelepasan-efluen', [PelepasanEflueanController::class, 'index'])->name('permohonan-pelepasan-efluen');
  Route::get('/permohonan/pelepasan-efluen/borang-individu/redirect', [PelepasanEflueanController::class, 'goToPage'])->name('go-to-permohonan-pelepasan-efluen-borang-individu');
  Route::get('/permohonan/pelepasan-efluen/borang-individu', [PelepasanEflueanController::class, 'create'])->name('permohonan-pelepasan-efluen-borang-individu');
  Route::get('/permohonan/pelepasan-efluen/borang-bisnes', [PelepasanEflueanController::class, 'create'])->name('permohonan-pelepasan-efluen-borang-bisnes');
  Route::post('/permohonan/pelepasan-efluen', [PelepasanEflueanController::class, 'store'])->name('permohonan-pelepasan-efluen-store');

  Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');
  Route::get('lang/{locale}', [LanguageController::class, 'swap']);
  Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

});

// Payment Route
Route::post('/payment', [PaymentController::class, 'create'])->name('create-payment');

// Admin
Route::middleware(['auth', 'role:Administrator'])->name('.admin')->prefix('admin')->group(function(){
  Route::get('/', [AdminController::class, 'UserManagement'])->name('index');
  Route::resource('/user-list', AdminController::class);

});
