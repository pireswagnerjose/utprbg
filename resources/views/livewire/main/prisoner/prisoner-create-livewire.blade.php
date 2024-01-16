<div>
    <div class="mx-auto p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
        {{-- Título da Página --}}
        <x-title-page>Cadastro de Preso</x-title-page>

        {{-- Formulário de Cadastro --}}
        <form wire:submit='create'>
            {{-- campos do formulário --}}
            @include('livewire.main.prisoner.includes.fields')
            
            {{-- botões cadastrar e cancelar --}}
            <div class="flex justify-end">
                <x-button class="mr-4">{{ __('Cadastrar') }} </x-button>
                <x-danger-button wire:click='cancel'>Cancelar</x-danger-button>
            </div>
        </form>
    </div>
</div>
