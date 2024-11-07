<div class="w-full">
    <div class="grid md:grid-cols-2 md:gap-8 mb-8 mt-12">
        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="date" wire:model="start_date" />
            <x-label for="start_date" value="{{ 'Data Inicial' }}" />
            <x-input-error for="start_date" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="date" wire:model="end_date" />
            <x-label for="end_date" value="{{ 'Data Final' }}" />
            <x-input-error for="end_date" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
    </div>
</div>