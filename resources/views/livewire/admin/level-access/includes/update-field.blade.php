<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="levelAccess" wire:model="levelAccess" />
        <x-label for="levelAccess" wire:model="levelAccess" value="{{ 'Nível de Acesso' }}" />
        <x-input-error for="level_access" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>