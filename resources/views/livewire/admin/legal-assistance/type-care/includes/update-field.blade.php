<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="type_care" wire:model="type_care" />
        <x-label for="type_care" wire:model="type_care" value="{{ 'Tipo do Atendimento' }}" />
        <x-input-error for="type_care" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>