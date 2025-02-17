<div>
  {{-- add new --}}
  <div class="flex items-center">
    @can('create_prisoner')
    <div>
      <button wire:click="modal" type="button"
        class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
      </button>
    </div>
    @endcan
  </div>

  <div class="mx-auto bg-white dark:bg-zinc-800 md:rounded-lg shadow-lg">
    {{-- Título da Página --}}
    <x-title-page>Pesquisa de Presos</x-title-page>
    {{-- fields seach --}}
    <div class=" p-6 overflow-hidden">
      @include('livewire.pages.prisoner.includes.search-field')
    </div>
    {{-- conteúdo da pesquisa --}}
    <div class="border-t pt-4 border-blue-700 dark:border-blue-600">
      @include('livewire.pages.prisoner.includes.search-card')
    </div>
    {{-- paginação --}}
    <div class="border-t p-4 border-blue-700 dark:border-blue-600">
      {{ $prisoners->onEachSide(1)->links() }}
    </div>
  </div>
  {{-- modal create --}}
  <form wire:submit="save">
    @include('livewire.pages.prisoner.includes.modal')
  </form>
</div>