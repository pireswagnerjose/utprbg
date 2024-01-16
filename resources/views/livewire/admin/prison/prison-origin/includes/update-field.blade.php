<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="prisonOrigin" wire:model="prisonOrigin" />
        <x-label for="prisonOrigin" wire:model="prisonOrigin" value="{{ 'Origem da Prisão' }}" />
        <x-input-error for="prison_origin" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>