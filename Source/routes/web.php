<?php

use App\Livewire\DashboardPage;
use App\Livewire\AdminPage;
use App\Livewire\SettingsPage;
use App\Livewire\GuestPage;
use App\Livewire\RoomsPage;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
use App\Livewire\ReservationPage;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', DashboardPage::class)->name('dashboard')->middleware('auth');
Route::get('/admin', AdminPage::class)->name('admin')->middleware('auth');
Route::get('/settings', SettingsPage::class)->name('settings')->middleware('auth');
Route::get('/guests', GuestPage::class)->name('guests')->middleware('auth');
Route::get('/rooms', RoomsPage::class)->name('rooms')->middleware('auth');
Route::get('/reservations', ReservationPage::class)->name('reservations')->middleware('auth');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/reset-password', function () {
    return redirect()->route('password.request');
});
