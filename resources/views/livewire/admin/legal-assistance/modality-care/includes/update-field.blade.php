<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="modality_care" wire:model="modality_care" />
        <x-label for="modality_care" wire:model="modality_care" value="{{ 'Modalidade do Atendimento' }}" />
        <x-input-error for="modality_care" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>