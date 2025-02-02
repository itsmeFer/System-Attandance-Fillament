<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    // Metode untuk check-in
    public function checkIn(Request $request)
    {
        $request->validate([
            'check_in_location' => 'required|string',
            'photo' => 'required|image',
        ]);

        // Simpan foto yang diupload
        $photoPath = $request->file('photo')->store('attendance_photos', 'public');

        // Simpan data absensi check-in
        Attendance::create([
            'user_id' => Auth::id(),
            'check_in' => now(),
            'check_in_location' => $request->check_in_location,
            'photo' => $photoPath,
        ]);

        return redirect()->back()->with('message', 'Absen Masuk Berhasil');
    }

    // Metode untuk check-out
    public function checkOut(Request $request)
    {
        $request->validate([
            'check_out_location' => 'required|string',
            'photo' => 'required|image',
        ]);

        // Simpan foto yang diupload
        $photoPath = $request->file('photo')->store('attendance_photos', 'public');

        // Cari absensi yang sedang aktif (belum check-out)
        $attendance = Attendance::where('user_id', Auth::id())
                                ->whereNull('check_out')
                                ->first();

        if ($attendance) {
            $attendance->update([
                'check_out' => now(),
                'check_out_location' => $request->check_out_location,
                'photo' => $photoPath,
            ]);

            return redirect()->back()->with('message', 'Absen Keluar Berhasil');
        }

        return redirect()->back()->with('error', 'Tidak ada absensi masuk yang aktif');
    }
}
