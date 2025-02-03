<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class EmployeeAttendanceForm extends Component
{
    use WithFileUploads;

    public $check_in_location, $check_out_location, $photo;
    public $attendance;

    public function mount()
    {
        $this->attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', now()->toDateString())
            ->first();
    }

    public function checkIn()
    {
        $this->validate([
            'check_in_location' => 'required|string',
            'photo' => 'required|image|max:2048',
        ]);

        $photoPath = $this->photo->store('attendance_photos', 'public');

        $this->attendance = Attendance::create([
            'user_id' => Auth::id(),
            'check_in' => now(),
            'check_in_location' => $this->check_in_location,
            'photo' => $photoPath,
        ]);

        session()->flash('success', 'Check-in berhasil!');
    }

    public function checkOut()
    {
        if (!$this->attendance) {
            session()->flash('error', 'Anda belum check-in!');
            return;
        }

        $this->validate([
            'check_out_location' => 'required|string',
        ]);

        $this->attendance->update([
            'check_out' => now(),
            'check_out_location' => $this->check_out_location,
        ]);

        session()->flash('success', 'Check-out berhasil!');
    }

    public function render()
    {
        return view('livewire.employee-attendance-form');
    }
}
