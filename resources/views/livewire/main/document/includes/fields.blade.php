{{-- linha1 --}}
<div class="relative z-0 w-full group mt-8 flex items-center justify-center">
    <input type="file" id="document" wire:model.live="document" class="rounded-md" />
    <x-input-error for="document" class="mt-2" />
</div>
{{-- linha2 --}}
<div class="grid md:grid-cols-3 md:gap-6 mt-8">
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="name" id="name" />
        <x-label for="name" wire:model="name" value="{{ 'Nome' }}" />
        <x-input-error for="name" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-2 relative z-0 w-full group">
        <x-input type="text" wire:model="description" id="description" />
        <x-label for="description" wire:model="description" value="{{ 'Breve descrição' }}" />
        <x-input-error for="description" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>