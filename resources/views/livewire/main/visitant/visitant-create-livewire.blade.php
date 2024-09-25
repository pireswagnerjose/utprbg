<div>
    <div class="mx-auto p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
        {{-- Título da Página --}}
        <x-title-page>Cadastro de Visitante</x-title-page>

        {{-- Formulário de Cadastro --}}
        <form wire:submit='create'>
            {{-- campos do formulário --}}
            @include('livewire.main.visitant.includes.fields')
        </form>
    </div>
</div>
