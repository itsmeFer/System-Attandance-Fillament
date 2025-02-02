@if(auth()->user()->role === 'admin')
    <p>Selamat datang, Admin!</p>
@elseif(auth()->user()->role === 'manager')
    <p>Selamat datang, Manager!</p>
@elseif(auth()->user()->role === 'karyawan')
    <p>Selamat datang, Karyawan!</p>
@endif
