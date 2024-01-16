<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="sex" wire:model="sex" />
        <x-label for="sex" wire:model="sex" value="{{ 'Sexo' }}" />
        <x-input-error for="sex" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>