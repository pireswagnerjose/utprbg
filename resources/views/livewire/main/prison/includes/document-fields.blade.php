<div class="">
    <div class="relative z-0 w-full group mt-8 flex items-center justify-center">
        <input type="file" id="document" wire:model.live="document" class="rounded-md" />
        <x-input-error for="document" class="mt-2" />
    </div>
    <div class="relative z-0 w-full group mt-12">
        <x-input type="text" wire:model="title" id="title_documet" />
        <x-label for="title" wire:model="title" value="{{ 'Título do Documento' }}" />
        <x-input-error for="title" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group mt-8">
        <x-input type="text" wire:model="description" id="description" />
        <x-label for="description" wire:model="description" value="{{ 'Breve discirção do documento' }}" />
        <x-input-error for="description" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>