<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Livewire\TemporaryUploadedFile;

class AbsensiKaryawan extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationLabel = 'Absensi Karyawan';
    protected static string $view = 'filament.pages.absensi-karyawan';

    public ?string $check_in_location = null;
    public ?TemporaryUploadedFile $photo = null;

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('check_in_location')
                ->label('Lokasi Check-in')
                ->required(),
            FileUpload::make('photo')
                ->label('Foto Absen')
                ->image()
                ->required(),
        ]);
    }

    public function submit()
    {
        Attendance::create([
            'user_id' => Auth::id(),
            'check_in' => now(),
            'check_in_location' => $this->check_in_location,
            'photo' => $this->photo instanceof TemporaryUploadedFile
                ? $this->photo->store('absensi', 'public')
                : null,
        ]);

        session()->flash('success', 'Absen berhasil!');
        return redirect()->route('filament.admin.pages.dashboard-karyawan');
    }
}
