<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <button type="submit" class="filament-button">Submit</button>
    </form>
</x-filament::page>
