<div class="mx-auto bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
    {{-- Título --}}
    <x-title-page>Dados do Advogado</x-title-page>
    @include('livewire.admin.legal-assistance.lawyers.includes.show-card')

    @include('livewire.admin.legal-assistance.lawyers.includes.modal-update')
    @include('livewire.admin.legal-assistance.lawyers.includes.modal-delete')
</div>
