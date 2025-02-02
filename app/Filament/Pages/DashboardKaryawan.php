<?php

namespace App\Filament\Pages;

use App\Models\Attendance;
use Filament\Pages\Page;
use Filament\Forms;
use Illuminate\Support\Facades\Storage;

class DashboardKaryawan extends Page
{
    protected static ?string $navigationLabel = 'Dashboard Karyawan'; // Nama menu

    protected static string $view = 'filament.pages.dashboard-karyawan'; // Nama view custom

    public $check_in_location;
    public $check_out_location;
    public $photo;

    // Melakukan pengecekan pada user yang login
    public function mount()
    {
        // Cek apakah user adalah karyawan
        if (auth()->user()->role !== 'karyawan') {
            abort(403); // Jika bukan karyawan, akses ditolak
        }
    }

    // Fungsi untuk mengirimkan data absensi
    public function submitAttendance()
    {
        // Validasi jika foto absen diunggah
        if ($this->photo) {
            // Simpan foto dan ambil path
            $photoPath = $this->photo->store('photos', 'public');
        }

        // Menyimpan data absensi
        Attendance::create([
            'user_id' => auth()->id(),
            'check_in' => now(), // Waktu check-in
            'check_in_location' => $this->check_in_location,
            'photo' => $photoPath ?? null, // Menyimpan path foto jika ada
        ]);

        // Menambahkan notifikasi sukses
        session()->flash('message', 'Absen berhasil!');
    }

    // Skema form untuk input data absensi
    protected function getFormSchema(): array
    {
        return [
            // Input untuk lokasi check-in
            Forms\Components\TextInput::make('check_in_location')
                ->label('Lokasi Check-In')
                ->required(),

            // Upload foto saat absensi
            Forms\Components\FileUpload::make('photo')
                ->label('Foto Absen')
                ->required()
                ->disk('public')
                ->directory('photos')
                ->image()
                ->maxSize(1024)
                ->columnSpan(2), // Mengatur lebar kolom

            // Tombol untuk melakukan absen
            Forms\Components\Button::make('Absen')
                ->action('submitAttendance') // Menghubungkan dengan fungsi submit
                ->label('Absen Sekarang')
                ->color('primary'),
        ];
    }
}
