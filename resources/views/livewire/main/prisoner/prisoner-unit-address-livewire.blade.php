{{-- endereço do preso na unidade --}}
<div class="mt-4 text-center">
    @if (empty( $unitAddress->prisoner_id))
        <button wire:click="modalUnitAddress({{ $prisoner_id }})" class="font-normal text-xs text-blue-600 dark:text-blue-500 hover:underline">Cadastrar Cela</button>
    @endif
    @if (!empty( $unitAddress->prisoner_id))
        <dd class="font-normal text-xs">ALA / CELA</dd>
        <dd class="text-sm font-semibold uppercase">{{ $unitAddress->cell->cell }}</dd>
        <button wire:click="modalUnitAddress({{ $prisoner_id }})" class="font-normal text-xs text-red-600 dark:text-red-500 hover:underline">Mudar de Cela</button>
    @endif
    @include('livewire.main.prisoner.includes.modal-unit-address')
</div>
