<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="educationLevel" wire:model="educationLevel" />
        <x-label for="educationLevel" wire:model="educationLevel" value="{{ 'Escolaridade' }}" />
        <x-input-error for="education_level" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>