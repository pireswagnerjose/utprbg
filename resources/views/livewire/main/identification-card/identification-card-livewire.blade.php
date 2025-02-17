<div>
  {{-- add new --}}
  <div class="flex items-center border-b border-blue-400 dark:border-blue-600 mb-4">
    @can('create_identification_card')
    <div>
      <button wire:click="modalCreate" type="button"
        class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
      </button>
    </div>
    @endcan
  </div>

  {{-- Título da Página --}}
  <x-title-page>Selecione um visitante ou um preso para fazer a consulta</x-title-page>

  <div class="
      mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800
      overflow-hidden shadow-sm sm:rounded-b-lg text-zinc-900 dark:text-zinc-100
    ">
    <form>
      @include('livewire.main.identification-card.includes.search-field')
    </form>
  </div>

  <div
    class="mx-auto mt-6 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
    {{-- paginação --}}
    <div class="pl-2 py-4 mb-4 text-zinc-50 dark:text-zinc-400 border-b border-blue-300 dark:border-blue-500 pb-3">
      {{ $identification_cards->onEachSide(1)->links() }}
    </div>
    {{-- MODAL PRISON --}}
    @include('livewire.main.identification-card.includes.modal-create')
    @include('livewire.main.identification-card.includes.search-card')
  </div>
</div>