<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="typeService" wire:model="typeService" />
        <x-label for="typeService" wire:model="typeService" value="{{ 'Tipo de Atendimento Interno' }}" />
        <x-input-error for="type_service" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>