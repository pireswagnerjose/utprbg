<x-dialog-modal wire:model="openModalReport" maxWidth="xl">
    <x-slot name="title">
        {{ 'Ficha do Preso' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.prisoner.includes.report-itens')
    </x-slot>

    <x-slot name="footer"></x-slot>
</x-dialog-modal>
