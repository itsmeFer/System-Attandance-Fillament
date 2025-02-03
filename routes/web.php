<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\EmployeeAttendanceForm;
use App\Filament\Pages\DashboardKaryawan;

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin Dashboard
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });

    // Manager Dashboard
    Route::middleware(['role:manager'])->group(function () {
        Route::get('/manager/dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
    });

    // Karyawan Dashboard & Absensi
    Route::middleware(['auth', 'verified', 'role:karyawan'])->group(function () {
        Route::get('/karyawan/attendance', [DashboardKaryawan::class, 'index'])->name('karyawan.attendance');
        Route::post('/karyawan/attendance/check-out', [DashboardKaryawan::class, 'submitCheckOut'])->name('karyawan.check-out');
    });
    

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
