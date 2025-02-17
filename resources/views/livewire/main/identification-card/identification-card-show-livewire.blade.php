<div class="py-1 mx-4">
  {{-- Título da Página --}}
  <x-title-page>Dados do Cartão de Identificação do Visitante</x-title-page>
  <div
    class="mx-auto p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-b-lg text-zinc-900 dark:text-zinc-100">
    <div class="flex justify-end mb-5">
      {{-- botões --}}
      <div class="flex justify-end gap-2 px-2">

        {{-- chama o modal para exclusão do item --}}
        @can('delete_identification_card')
        <div class="group grid justify-items-center w-16">
          <button type="button" wire:click="modalDelete({{ $identification_card->id }})"
            class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
            <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
          </button>
        </div>
        @endcan


        {{-- Editar --}}
        @can('update_identification_card')
        <div class="group grid justify-items-center w-16">
          <button wire:click="modalUpdate({{ $identification_card->id }})"
            class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
            <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
          </button>
        </div>
        @endcan

        {{-- Relatório PDF --}}
        @can('create_pdf_identification_card')
        <div class="group grid justify-items-center w-16">
          <a href="{{ route('identification-card.pdf', ['identification_card_id' => $identification_card->id]) }}"
            target="_blank"
            class="p-2 bg-green-500 dark:bg-green-400/50 hover:opacity-50 transition duration-500 rounded-full">
            <x-lucide-file-text class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-file-text>
          </a>
        </div>
        @endcan
      </div>
    </div>

    @include('livewire.main.identification-card.includes.show-card')

    @include('livewire.main.identification-card.includes.modal-update')
    @include('livewire.main.identification-card.includes.modal-delete')
  </div>