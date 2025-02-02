<x-filament::page>
    <h1>Dashboard Karyawan</h1>
    <p>Selamat datang, {{ auth()->user()->name }}! Silakan lakukan absensi.</p>

    <x-filament::form :action="route('filament.pages.dashboard-karyawan')">
        {{ $this->form }}
    </x-filament::form>
</x-filament::page>
