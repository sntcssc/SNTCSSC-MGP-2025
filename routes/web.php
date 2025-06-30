<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('registration/register', [RegistrationController::class, 'showRegistrationForm'])->name('registration-form');

Route::get('/thank-you/{registration_id}', function ($registration_id) {
    return view('thank-you', compact('registration_id'));
})->name('thank-you');

Route::get('/download-application/{id}', [RegistrationController::class, 'downloadApplication'])->name('download-application');


Route::get('/download/{id}', [RegistrationController::class, 'download'])->name('register.download');
Route::get('/apply', [RegistrationController::class, 'showForm'])->name('register.form');
Route::post('/apply/upload', [RegistrationController::class, 'uploadDocument'])->name('register.upload');
Route::post('/apply', [RegistrationController::class, 'store'])->name('register.store');

require __DIR__.'/auth.php';
