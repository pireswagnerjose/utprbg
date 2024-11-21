<!-- update-->
<x-dialog-modal wire:model="openModal" maxWidth="2xl">
    <x-slot name="title">
        {{ 'Cadastra Foto do Perfil do Preso' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.pages.unit-address.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <button type="button" wire:click="closeModal"
            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 transition ease-in-out duration-150">
            {{ __('Cancel') }}
        </button>
        
        <x-blue-button class="ms-3">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
