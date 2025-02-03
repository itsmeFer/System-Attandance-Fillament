<?php

namespace App\Filament\Pages;

use App\Models\Attendance;
use Filament\Pages\Page;
use Filament\Forms;
use Illuminate\Support\Facades\Storage;

class DashboardKaryawan extends Page
{
    protected static ?string $navigationLabel = 'Dashboard Karyawan';    
    protected static string $view = 'filament.pages.dashboard-karyawan'; // Nama view custom

    public $check_in_location;
    public $check_out_location;
    public $photo;

    public function mount()
    {
        if (auth()->user()->role !== 'karyawan') {
            abort(403);
        }
    }

    // Fungsi untuk melakukan absensi
    public function submitAttendance()
    {
        // Validasi dan simpan foto jika ada
        if ($this->photo) {
            $photoPath = $this->photo->store('photos', 'public');
        }

        // Simpan data absensi
        Attendance::create([
            'user_id' => auth()->id(),
            'check_in' => now(),
            'check_in_location' => $this->check_in_location,
            'photo' => $photoPath ?? null,
        ]);

        session()->flash('message', 'Absen berhasil!');
    }

    // Fungsi untuk melakukan check-out
    public function submitCheckOut()
    {
        // Cek apakah karyawan sudah check-in
        $attendance = Attendance::where('user_id', auth()->id())
                                 ->whereNull('check_out')
                                 ->first();

        if ($attendance) {
            // Update data check-out
            $attendance->update([
                'check_out' => now(),
                'check_out_location' => $this->check_out_location,
            ]);

            session()->flash('message', 'Check-out berhasil!');
        } else {
            session()->flash('error', 'Anda belum melakukan check-in!');
        }
    }

    // Skema form absensi
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('check_in_location')
                ->label('Lokasi Check-In')
                ->required(),

            Forms\Components\FileUpload::make('photo')
                ->label('Foto Absen')
                ->image()
                ->maxSize(1024)
                ->disk('public')
                ->directory('photos')
                ->nullable()
                ->columnSpan(2),

            Forms\Components\Button::make('Absen')
                ->action('submitAttendance')
                ->label('Absen Sekarang')
                ->color('primary'),

            Forms\Components\TextInput::make('check_out_location')
                ->label('Lokasi Check-Out')
                ->nullable(),

            Forms\Components\Button::make('Check-Out')
                ->action('submitCheckOut')
                ->label('Check-Out Sekarang')
                ->color('secondary'),
        ];
    }
}
