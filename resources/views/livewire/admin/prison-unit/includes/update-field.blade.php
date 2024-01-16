<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="prisonUnit" wire:model="prisonUnit" />
        <x-label for="prisonUnit" wire:model="prisonUnit" value="{{ 'Unidade Prisional' }}" />
        <x-input-error for="prison_unit" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>