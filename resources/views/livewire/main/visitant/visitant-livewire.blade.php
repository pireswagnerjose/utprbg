<div>
  {{-- add new --}}
  <div class="flex items-center">
    @can('create_visitant')
    <div>
      <button wire:click="modalCreate" type="button"
        class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
      </button>
    </div>
    @endcan
  </div>

  {{-- Título da Página --}}
  <x-title-page>Pesquisa de Visitante</x-title-page>

  <div class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800
            overflow-hidden shadow-sm sm:rounded-b-lg text-zinc-900 dark:text-zinc-100">
    <form>
      @include('livewire.main.visitant.includes.search-field')
    </form>
  </div>

  <div class="pt-4">
    <!-- Formulário Pdf -->
    <form action="{{ route('visitant-list.pdf') }}" method="post" target="_blank">
      @csrf
      <input type="hidden" name="name" value="{{ $visitantForm->name }}">
      <input type="hidden" name="cpf" value="{{ $visitantForm->cpf }}">
      <input type="hidden" name="date_of_birth" value="{{ $visitantForm->date_of_birth }}">
      <input type="hidden" name="phone" value="{{ $visitantForm->phone }}">
      <input type="hidden" name="status" value="{{ $visitantForm->status }}">
      <input type="hidden" name="sex_id" value="{{ $visitantForm->sex_id }}">
      {{-- Gerar PDF --}}
      <div class="flex justify-end mb-2">
        <x-blue-button class=" bg-blue-600">{{ 'Gerar PDF' }} </x-blue-button>
      </div>
    </form>
    <!-- end Formulário Pdf -->
  </div>

  <div class="mx-auto p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800
            overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
    @include('livewire.main.visitant.includes.search-card')
    @include('livewire.main.visitant.includes.modal-create')

    {{-- paginação --}}
    <div class="pl-2 py-4 mt-2 text-zinc-50 dark:text-zinc-400
                border-t border-blue-300 dark:border-blue-500 pb-3">
      {{ $visitants->onEachSide(1)->links() }}
    </div>
  </div>
</div>