<div class="p-4 bg-white shadow-md rounded-md">
    <h2 class="text-lg font-semibold mb-4">Absensi Hari Ini</h2>

    @if (session()->has('success'))
        <div class="bg-green-500 text-white p-2 mb-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-500 text-white p-2 mb-2 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if (!$attendance)
        <form wire:submit.prevent="checkIn">
            <div class="mb-3">
                <label for="check_in_location" class="block font-medium">Lokasi Check-in</label>
                <input type="text" wire:model="check_in_location" class="w-full border rounded p-2">
                @error('check_in_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="photo" class="block font-medium">Foto</label>
                <input type="file" wire:model="photo" class="w-full border rounded p-2">
                @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Check In</button>
        </form>
    @else
        <p class="text-green-500 font-semibold">Anda sudah check-in hari ini.</p>

        @if (!$attendance->check_out)
            <form wire:submit.prevent="checkOut" class="mt-4">
                <div class="mb-3">
                    <label for="check_out_location" class="block font-medium">Lokasi Check-out</label>
                    <input type="text" wire:model="check_out_location" class="w-full border rounded p-2">
                    @error('check_out_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Check Out</button>
            </form>
        @else
            <p class="text-blue-500 font-semibold">Anda sudah check-out hari ini.</p>
        @endif
    @endif
</div>
