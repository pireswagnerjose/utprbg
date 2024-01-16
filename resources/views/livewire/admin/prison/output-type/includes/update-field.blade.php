<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="outputType" wire:model="outputType" />
        <x-label for="outputType" wire:model="outputType" value="{{ 'Tipo de Saída' }}" />
        <x-input-error for="output_type" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>