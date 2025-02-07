<div>
    {{-- Alert component --}}
    <div class="my-2">
        @include('livewire.pages.prisoner.includes.alerts')
    </div>

    <div
        class="mx-auto bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
        {{-- Título --}}
        <x-title-page>Dados do Preso</x-title-page>
        {{-- Conteúdo --}}
        @include('livewire.pages.prisoner.includes.card')
    </div>
    {{-- tabs --}}
    <div class="mt-1">
        @can('show_prisoners_data')
        @include('livewire.pages.prisoner.includes.tabs')
        @endcan
    </div>

    <form wire:submit="save">
        @include('livewire.pages.prisoner.includes.modal')
    </form>

    <form wire:submit="profilePhoto({{ $prisoner_show->id }})">
        @include('livewire.pages.prisoner.includes.modal-profile-photo')
    </form>

    @include('livewire.pages.prisoner.includes.report-modal-select')
</div>