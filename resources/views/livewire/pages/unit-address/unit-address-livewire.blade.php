{{-- endereço do preso na unidade --}}
<div class="text-center">
    @if (empty( $unitAddress->prisoner_id))
        <button wire:click="modal({{ $prisoner_id }})"
            class="font-normal text-xs text-blue-600 dark:text-blue-500 hover:underline">Cadastrar Cela</button>
    @endif
    @if (!empty( $unitAddress->prisoner_id))
        <button wire:click="modal({{ $prisoner_id }})"
            class="font-normal text-xs text-red-600 dark:text-red-500 hover:underline">Mudar de Cela</button>
    @endif
    <form wire:submit='save({{ $prisoner_id }})'>
        @include('livewire.pages.unit-address.includes.modal')
    </form>
</div>